<?php

namespace App\Http\Controllers;

use App\Models\ModelUser;
use App\Models\ModelOutlet;
use App\Models\ModelRoles;
use App\Models\ModelUserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserPermissionsController extends Controller
{
    public function index()
    {
        $userPermissions = ModelUserPermission::with(['operator', 'outlet', 'role'])->get();
        return view('admin.permissions.index', compact('userPermissions'));
    }

    public function create()
    {
        $outlets = ModelOutlet::all();
        $roles = ModelRoles::all();
        $userPermission = null; // Set null untuk halaman create
        return view('admin.permissions.form', compact('outlets', 'roles', 'userPermission'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required|exists:roles,role_id',
            'outlet_id' => 'required|exists:outlets,outlet_id',
            // tambahkan validasi untuk field lainnya
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $request->merge(['operator_id' => Auth::id()]);
        ModelUserPermission::create($request->all());

        return redirect()->route('user-permissions.index')->with('success', 'Pengaturan akses pengguna berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $userPermission = ModelUserPermission::findOrFail($id);
        $outlets = ModelOutlet::all();
        $roles = ModelRoles::all();
        return view('admin.permissions.form', compact('userPermission', 'outlets', 'roles')); // gunakan view yang sama (admin.permissions.form)
    }

    public function update(Request $request, $id)
    {
        $userPermission = ModelUserPermission::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'role_id' => 'required|exists:roles,role_id',
            'outlet_id' => 'required|exists:outlets,outlet_id',
            // tambahkan validasi untuk field lainnya
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $request->merge(['operator_id' => Auth::id()]);
        $userPermission->update($request->all());


        return redirect()->route('user-permissions.index')->with('success', 'Pengaturan akses pengguna berhasil diupdate.');
    }
    public function destroy($id)
    {
        $userPermission = ModelUserPermission::findOrFail($id);
        $userPermission->delete();
        return redirect()->route('user-permissions.index')->with('success', 'Pengaturan akses pengguna berhasil dihapus.');
    }
}
