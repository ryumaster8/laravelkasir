<?php

namespace App\Http\Controllers;

use App\Models\ModelUser;
use App\Models\ModelOutlet;
use App\Models\ModelMembership;
use App\Models\ModelRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
        $outlets = ModelOutlet::all();
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

        return redirect()->route('user.index')->with('success', 'Pengguna berhasil diupdate.');
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
}
