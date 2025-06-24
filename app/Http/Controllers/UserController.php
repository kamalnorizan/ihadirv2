<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    function index()
    {
        $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.index', compact('users', 'roles', 'permissions'));
    }

    public function assignRole(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        if ($request->roles) {
            $roles = Role::whereIn('id', $request->roles)->get();
            $user->syncRoles($roles);
        } else {
            $user->syncRoles([]);
        }

        if ($request->permissions) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $user->syncPermissions($permissions);
        } else {
            $user->syncPermissions([]);
        }


        return response()->json([
            'status' => 'success',
            'message' => 'Role(s) assigned successfully.',
        ]);
    }

    public function assignPermission(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        if($request->permissions) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $role->givePermissionTo($permissions);
        }else {
            $role->syncPermissions([]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Permission successfully revoked.',
        ], 200);

    }

    public function removePermission(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        $role->revokePermissionTo($request->permission);

        return response()->json([
            'status' => 'success',
            'message' => 'Permission successfully revoked.',
        ], 200);

    }
}
