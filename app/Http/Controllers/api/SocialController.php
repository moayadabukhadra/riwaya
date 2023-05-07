<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function facebookRedirect(Request $request)
    {
        $provider = "facebook";
        $token = $request->input('access_token');
        $providerUser = Socialite::driver($provider)->userFromToken($token);
        $user = User::where('fb_id', $providerUser->id)->first();
        if($user == null){
            $user = User::create([
                'provider_name' => $provider,
                'provider_id' => $providerUser->id,
            ]);
        }

        $token = $user->createToken('Riwaya')->accessToken;
        return response()->json([
            'success' => true,
            'token' => $token
        ]);
    }

    public function loginWithFacebook()
    {
        header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

        return Socialite::driver('facebook')->stateless()->user();
    }

}
