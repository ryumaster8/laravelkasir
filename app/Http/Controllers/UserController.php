<?php

namespace App\Http\Controllers;

use App\Models\ModelUser;
use App\Models\ModelRoles;
use App\Models\ModelOutlet;
use Illuminate\Http\Request;
use App\Models\ModelMembership;
use App\Models\ModelActivityLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        // Ambil semua pengguna dari semua outlet
        $users = ModelUser::with(['outlet', 'role'])->get();

        // Ambil semua outlet
        $outlets = ModelOutlet::all();

        // Ambil semua role
        $roles = ModelRoles::all();

        // Hitung jumlah total pengguna
        $totalUsers = $users->count();

        // Ambil batas pengguna dari membership
        $userLimits = [];
        foreach ($outlets as $outlet) {
            if ($outlet->membership_id) {
                $membership = ModelMembership::find($outlet->membership_id);
                if ($membership) {
                    $userLimits[$outlet->outlet_group_id] = $membership->user_limit;
                }
            }
        }

        return view('admin.users.index', compact('users', 'totalUsers', 'userLimits', 'roles'));
    }

    public function create()
    {
        // Ambil semua outlet
        $outlets = ModelOutlet::all();

        // Ambil semua role
        $roles = ModelRoles::all();

        // Ambil semua pengguna dari semua outlet
        $users = ModelUser::all();

        // Hitung jumlah total pengguna
        $totalUsers = $users->count();

        // Ambil batas pengguna dari membership (kita ambil satu saja untuk contoh)
        $userLimit = 0;
        $outlet = ModelOutlet::first();
        if ($outlet && $outlet->membership_id) {
            $membership = ModelMembership::find($outlet->membership_id);
            if ($membership) {
                $userLimit = $membership->user_limit;
            }
        }

        return view('admin.users.create', compact('outlets', 'roles', 'totalUsers', 'userLimit'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone_number' => 'nullable|string|max:20',
            'role_id' => 'required|exists:roles,role_id',
            'outlet_id' => 'required|exists:outlets,outlet_id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        ModelUser::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'role_id' => $request->role_id,
            'outlet_id' => $request->outlet_id,
        ]);

        return redirect()->route('user.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = ModelUser::findOrFail($id);
        
        // Get outlets from the same group as the user's current outlet
        $outlets = $user->outlet->getSameGroupOutlets();
        
        // Add the user's current outlet to the list if not already included
        $currentOutlet = $user->outlet;
        if (!$outlets->contains('outlet_id', $currentOutlet->outlet_id)) {
            $outlets->push($currentOutlet);
        }
        
        // Sort all outlets by name
        $outlets = $outlets->sortBy('outlet_name');
        
        $roles = ModelRoles::all();

        return view('admin.users.edit', compact('user', 'outlets', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = ModelUser::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username,' . $user->user_id . ',user_id',
            'email' => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
            'password' => 'nullable|min:6|confirmed',
            'phone_number' => 'nullable|string|max:20',
            'role_id' => 'required|exists:roles,role_id',
            'outlet_id' => 'required|exists:outlets,outlet_id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            // Get role names for logging
            $oldRole = ModelRoles::find($user->role_id);
            $newRole = ModelRoles::find($request->role_id);

            // Store old values for logging
            $oldValues = [
                'username' => $user->username,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'role_id' => ['id' => $user->role_id, 'name' => $oldRole ? $oldRole->role_name : 'unknown'],
                'outlet_id' => $user->outlet_id
            ];

            // Update user data
            $userData = [
                'username' => $request->username,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'role_id' => $request->role_id,
                'outlet_id' => $request->outlet_id,
            ];
            
            if ($request->password) {
                $userData['password'] = Hash::make($request->password);
            }

            $user->update($userData);

            // Create activity log
            $changes = [];
            foreach ($userData as $key => $value) {
                if ($key === 'role_id' && $oldValues[$key]['id'] != $value) {
                    $changes[] = sprintf(
                        "Role: %s → %s",
                        ucfirst($oldValues[$key]['name']),
                        ucfirst($newRole ? $newRole->role_name : 'unknown')
                    );
                } elseif ($key != 'password' && $key != 'role_id' && $oldValues[$key] != $value) {
                    $changes[] = ucfirst($key) . ": {$oldValues[$key]} → {$value}";
                }
            }
            
            if (!empty($changes)) {
                $logDetails = "Mengubah data pengguna: " . implode(", ", $changes);
                ModelActivityLog::createLog(
                    auth()->id(),
                    $user->outlet_id,
                    'UPDATE_USER',
                    $logDetails
                );
            }

            DB::commit();
            return redirect()->route('user.index')->with('success', 'Pengguna berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal mengupdate pengguna: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $user = ModelUser::findOrFail($id);
        try {
            DB::beginTransaction();
            $user->delete();
            DB::commit();
            return redirect()->route('user.index')->with('success', 'Pengguna berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('user.index')->with('error', 'Gagal menghapus pengguna.');
        }
    }

    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();
            
            $user = ModelUser::findOrFail($id);
            $newStatus = request('status');
            $oldStatus = $user->status;
            
            $user->update([
                'status' => $newStatus
            ]);

            // Create activity log
            ModelActivityLog::createLog(
                auth()->id(),
                $user->outlet_id,
                'TOGGLE_USER_STATUS',
                "Mengubah status pengguna {$user->username} dari {$oldStatus} menjadi {$newStatus}"
            );

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Status pengguna berhasil diubah menjadi {$newStatus}"
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah status pengguna: ' . $e->getMessage()
            ], 500);
        }
    }
}
