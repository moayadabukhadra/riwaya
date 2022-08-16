<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)

    {
       $fields= request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        $fields['password'] = bcrypt($request->password);
        $user = User::create($fields);
        $token = $user->createToken('riwayaToken')->plainTextToken;
        $response=[
            'user' => $user,
            'token' => $token
        ];
        return response($response,201);

    }

    public function login(Request $request)
    {
        $login = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // check if the user exists
        $user = User::where('email',$login['email'])->first();

        // check if the password is correct
        if(!$user || !Hash::check($login['password'],$user->password)){
            return response(['message'=>'Invalid credentials'],401);
        }

        // generate a new token
        $token = $user->createToken('riwayaToken')->plainTextToken;
        $response=[
            'user' => $user,
            'token' => $token
        ];
        return response($response,200);

    }

    

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response(['message'=>'logout successfully'],200);
    }

}
