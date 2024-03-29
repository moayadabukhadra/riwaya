<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ResetPassword;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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

        $user = User::where('email', $email)->firstOrFail();

        if ($user) {
            $token = app('auth.password.broker')->createToken($user);
            $user->notify(new ResetPassword($token, $email));
            return response()->json([
                'message' => 'Reset password link sent on your email.'
            ], 200, [], JSON_PRETTY_PRINT);
        } else {
            return response()->json(['message' => 'failed'], 401, [], JSON_PRETTY_PRINT);
        }

    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
        ], [
            'token.required' => 'حدث خطأ ما',
            'email.required' => 'حدث خطأ ما',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
        ]);

        $passwordReset = app('auth.password.broker')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();

                $user->setRememberToken(Str::random(60));

                event(new PasswordReset($user));
            }
        );

        if ($passwordReset == Password::INVALID_TOKEN) {
            return response()->json([
                'message' => 'حدث خطأ ما'
            ], 400, [], JSON_PRETTY_PRINT);
        }

        return response()->json([
            'message' => 'تم تغيير كلمة المرور بنجاح'
        ], 200, [], JSON_PRETTY_PRINT);
    }


}
