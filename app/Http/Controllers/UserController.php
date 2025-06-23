<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('users.index', compact('users','roles'));
    }

    public function assignRole(Request $request) {
        $user = User::findOrFail($request->user_id);

        $roles = Role::whereIn('id', $request->roles)->get();
        $user->syncRoles($roles);

        return response()->json([
            'status' => 'success',
            'message' => 'Role(s) assigned successfully.',
        ]);
    }
}
