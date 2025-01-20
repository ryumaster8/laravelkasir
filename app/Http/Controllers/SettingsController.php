<?php

namespace App\Http\Controllers;

use App\Models\ModelUserPermission;
use App\Models\ModelUser;
use App\Models\ModelOutlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class SettingsController extends Controller
{
    public function userPermissions()
    {
        $permissions = ModelUserPermission::with('user', 'outlet')->get();
        return view('admin.settings.user-permissions', compact('permissions'));
    }

    public function create()
    {
        $user = Auth::user();
        $outlets = ModelOutlet::where('outlet_group_id', $user->outlet->outlet_group_id)->get();
        return view('admin.settings.create-user-permissions', compact('outlets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'outlet_id' => 'nullable|exists:outlets,outlet_id',
            'role' => 'required|in:User,Admin',
        ]);

        $request->merge(['user_id' => session('user_id')]);

        Log::debug('Data Request pada SettingsController@store:', $request->all()); // Log data request

        $permission = ModelUserPermission::create($request->all());

        Log::debug('Data Permission yang Tersimpan:', $permission->toArray()); // Log data yg tersimpan


        return redirect()->route('settings.userPermissions')->with('success', 'User permission created successfully.');
    }

    public function edit($id)
    {
        $userPermission = ModelUserPermission::with('user', 'outlet')->findOrFail($id);
        $user = Auth::user();
        $outlets = ModelOutlet::where('outlet_group_id', $user->outlet->outlet_group_id)->get();
        return view('admin.settings.edit-user-permissions', compact('userPermission', 'outlets'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'outlet_id' => 'nullable|exists:outlets,outlet_id',
            'role' => 'required|in:User,Admin',
        ]);
        $userPermission = ModelUserPermission::findOrFail($id);
        $userPermission->update($request->all());
        return redirect()->route('settings.userPermissions')->with('success', 'User permission updated successfully.');
    }

    public function destroy($id)
    {
        $userPermission = ModelUserPermission::findOrFail($id);
        $userPermission->delete();
        return redirect()->route('settings.userPermissions')->with('success', 'User permission deleted successfully.');
    }
}
