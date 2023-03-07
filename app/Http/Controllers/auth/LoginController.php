<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json(Auth::user(), 200, [], JSON_PRETTY_PRINT);
        }else{
            return response()->json(['message' => 'Invalid credentials'], 401, [], JSON_PRETTY_PRINT);
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out'], 200, [], JSON_PRETTY_PRINT);
    }
}
