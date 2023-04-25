<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('auth.login-form');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->route('book.index');
        }

        return redirect()->route('auth.show-login')->withErrors([
            'email' => 'معلومات الدخول غير صحيحة',
        ]);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ], [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الالكتروني مطلوب',
            'email.email' => 'البريد الالكتروني غير صحيح',
            'email.unique' => 'البريد الالكتروني مستخدم من قبل',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
        ]);

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        auth()->login($user);

        return redirect()->route('book.index')->with('success', 'تم التسجيل بنجاح');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('auth.show-login');
    }

    public function forgotPassword(Request $request)
    {
        $email = $request->email;

        $user = User::where('email', $email)->first();

        if ($user) {
            /* laravel passport */
            $token =  $user->createToken('authToken')->accessToken;
            $user->notify(new ResetPassword($token));

        }

        return response()->json([
            'message' => 'Reset password link sent on your email.'
        ], 200, [], JSON_PRETTY_PRINT);

    }


}
