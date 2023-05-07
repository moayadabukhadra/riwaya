<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function facebookRedirect()
    {
        header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

        return Socialite::driver('facebook')->stateless()->redirect()->getTargetUrl();
    }

    public function loginWithFacebook()
    {
        try {
            $user = Socialite::driver('facebook')->stateless()->user();
        } catch (ClientException $e) {
            return response()->json([
                'message' => 'الرجاء المحاولة مرة اخرى',
            ], 500);
        }

        $user = User::firstOrCreate([
            'email' => $user->getEmail(),
        ], [
            'name' => $user->getName(),
            'password' => bcrypt(Str::random(16)),
        ]);

        $token = $user->createToken('facebook')->accessToken;
        return response()->json([
            'token' => $token,
        ]);
    }

}
