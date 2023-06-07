<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function facebookRedirect()
    {
        header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

        return Socialite::driver('facebook')->stateless()->redirect();

    }

    public function loginWithFacebook(Request $request)
    {
        $accessToken = $request->get('accessToken');
        

        $user = Socialite::driver('facebook')->userFromToken($accessToken);

        $user = User::firstOrCreate([
            'email' => $user->email,
        ], [
            'name' => $user->name,
            'password' => bcrypt(Str::random(16)),
        ]);


        return response()->json([
            'user' => $user->load('image'),
            'token' => $user->createToken('Riwaya')->accessToken,
        ]);


    }

}
