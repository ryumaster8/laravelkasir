<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelOutlet;
use App\Models\ModelMembership;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use App\Models\ModelActivityLog;

class BranchController extends Controller
{
    public function create()
    {
        $parentOutlet = Auth::user()->outlet;
        if ($parentOutlet->status !== 'induk') {
            return redirect()->route('branches.index')->with('error', 'Anda tidak memiliki hak akses untuk menambah cabang.');
        }
        return view('admin.branches.create');
    }

    public function store(Request $request)
    {
        $parentOutlet = Auth::user()->outlet;

        if ($parentOutlet->status !== 'induk') {
            return redirect()->route('branches.index')
                ->with('error', 'Anda tidak memiliki hak akses untuk menambah cabang.');
        }

        try {
            // Get membership and validate branch limits
            $membership = $parentOutlet->membership;
            if (!$membership) {
                return redirect()->back()
                    ->with('error', 'Outlet tidak memiliki paket membership aktif.')
                    ->withInput();
            }

            $currentBranchCount = $parentOutlet->branchOutlets()->count();

            // Check if membership allows branch creation
            if (!$membership->canCreateBranch()) {
                return redirect()->back()
                    ->with('error', $membership->getBranchLimitMessage($currentBranchCount))
                    ->withInput();
            }

            // Check branch limit
            if ($membership->hasReachedBranchLimit($currentBranchCount)) {
                return redirect()->back()
                    ->with('error', $membership->getBranchLimitMessage($currentBranchCount))
                    ->withInput();
            }

            // Regular validation
            $validated = $request->validate([
                'outlet_name' => [
                    'required',
                    'string',
                    'max:255',
                    function ($attribute, $value, $fail) use ($parentOutlet) {
                        $existingOutlet = ModelOutlet::where('outlet_name', $value)
                            ->where('parent_outlet_id', $parentOutlet->outlet_id)
                            ->first();

                        if ($existingOutlet) {
                            $fail("Nama cabang <b>" . $value . "</b> sudah digunakan pada induk cabang yang sama.");
                        }
                    },
                ],
                'address' => 'required|string',
                'contact_info' => 'required|string|max:255',
            ]);

            \DB::beginTransaction();

            try {
                // Create new branch outlet
                $outlet = ModelOutlet::create([
                    'outlet_name' => $validated['outlet_name'],
                    'address' => $validated['address'],
                    'contact_info' => $validated['contact_info'],
                    'parent_outlet_id' => $parentOutlet->outlet_id,
                    'user_id' => Auth::user()->user_id,
                    'status' => 'cabang',
                    'jenis_outlet' => $parentOutlet->jenis_outlet,
                    'membership_id' => $parentOutlet->membership_id,
                    'registration_date' => Carbon::now()->toDateString(),
                    'outlet_group_id' => $parentOutlet->outlet_group_id,
                ]);

                // Log the activity with only existing columns
                ModelActivityLog::createLog(
                    Auth::user()->user_id,
                    $parentOutlet->outlet_id,
                    'create_branch',
                    sprintf(
                        'Menambahkan cabang baru "%s" dengan alamat "%s" dan kontak "%s"',
                        $outlet->outlet_name,
                        $outlet->address,
                        $outlet->contact_info
                    )
                );

                \DB::commit();

                return redirect()->route('branches.index')
                    ->with('success', 'Cabang <b>' . $outlet->outlet_name . '</b> berhasil ditambahkan.');

            } catch (\Exception $e) {
                \DB::rollback();
                \Log::error('Branch creation failed: ' . $e->getMessage());
                throw $e;
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed: ' . json_encode($e->errors()));
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (QueryException $e) {
            \Log::error('Database error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan database: ' . $e->getMessage())
                ->withInput();
        } catch (\Exception $e) {
            \Log::error('Unexpected error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function index()
    {
        $parentOutlet = Auth::user()->outlet;
        $currentBranchCount = null;
        $branchLimit = null;

        if ($parentOutlet && $parentOutlet->status === 'induk') {
            $outlets = ModelOutlet::with('parentOutlet')
                ->where('parent_outlet_id', $parentOutlet->outlet_id)
                ->get();
            $currentBranchCount = $outlets->count();
            if ($parentOutlet->membership_id) {
                $membership = ModelMembership::find($parentOutlet->membership_id);
                if ($membership) {
                    $branchLimit = $membership->branch_limit;
                }
            }
        } else {
            $outlets = ModelOutlet::with('parentOutlet')
                ->where('status', 'cabang')
                ->get();
        }

        return view('admin.branches.index', compact('outlets', 'currentBranchCount', 'branchLimit'));
    }

    public function edit(ModelOutlet $outlet)
    {
        $parentOutlet = Auth::user()->outlet;
        if ($parentOutlet->status !== 'induk') {
            return redirect()->route('branches.index')->with('error', 'Anda tidak memiliki hak akses untuk mengedit cabang.');
        }
        return view('admin.branches.edit', compact('outlet'));
    }
    public function update(Request $request, ModelOutlet $outlet)
    {
        $parentOutlet = Auth::user()->outlet;
        if ($parentOutlet->status !== 'induk') {
            return redirect()->route('branches.index')->with('error', 'Anda tidak memiliki hak akses untuk mengedit cabang.');
        }
        try {
            $request->validate([
                'outlet_name' => 'required|string|max:255',
                'address' => 'required|string',
                'contact_info' => 'required|string|max:255',
            ]);

            $outlet->update([
                'outlet_name' => $request->outlet_name,
                'address' => $request->address,
                'contact_info' => $request->contact_info,
            ]);

            return redirect()->route('branches.index')->with('success', 'Cabang berhasil diupdate.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate data. Silakan coba lagi.')->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan yang tidak terduga.')->withInput();
        }
    }

    public function destroy(ModelOutlet $outlet)
    {
        $parentOutlet = Auth::user()->outlet;
        if ($parentOutlet->status !== 'induk') {
            return redirect()->route('branches.index')->with('error', 'Anda tidak memiliki hak akses untuk menghapus cabang.');
        }
        $outlet->delete();
        return redirect()->route('branches.index')->with('success', 'Cabang berhasil dihapus.');
    }
}
