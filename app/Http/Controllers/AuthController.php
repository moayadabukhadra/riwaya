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

        $user = User::where('email', $email)->first();

        if ($user) {

            $token = app('auth.password.broker')->createToken($user);
            $user->notify(new ResetPassword($token));

        }

        return response()->json([
            'message' => 'Reset password link sent on your email.'
        ], 200, [], JSON_PRETTY_PRINT);

    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed',
        ]);

        $passwordReset = app('auth.password.broker')->reset(
            $request->only('password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request){
                return response()->json([
                    'message' =>'123'
                ], 400, [], JSON_PRETTY_PRINT);
                $user->forceFill([
                    'password' => Hash::make($request->get('password')),
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
            'message' => $passwordReset
        ], 200, [], JSON_PRETTY_PRINT);
    }


}
