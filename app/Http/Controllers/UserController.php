<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('user.user-table');
    }

    public function show(User $user = null)
    {
        $roles = Role::all();

        return view('user.user-form', compact('user', 'roles'));
    }

    public function store(Request $request, User $user = null)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user?->id,
            'role_id' => 'required|exists:roles,id',
        ]);
        $user = User::updateOrCreate(
            ['id' => $user?->id],
            [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => $requset->get('password') ? bcrypt($request->get('password')) : bcrypt('123'),
            ]
        );
        if($request->get('role_id')){
            $user->assignRole($request->get('role_id'));
        }

        if($request->get('remove_image')){
            $user->image()->delete();
        }
        if($request->hasFile('image')){
            $user->image()->delete();
            $user->saveImage($request->file('image'));
        }

        return redirect()->route('user.index');
    }

}
