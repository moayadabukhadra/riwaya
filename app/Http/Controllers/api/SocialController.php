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

    public function loginWithFacebook(Request $request)
    {
        $accessToken = $request->get('accessToken');

        try {
            $user = Socialite::driver('facebook')->userFromToken($accessToken);


            $user = User::firstOrCreate([
                'email' => $user->email,
            ], [
                'name' => $user->name,
                'password' => bcrypt(Str::random(16)),
                'provider_id' => $user->id,
            ]);

            $success['token'] = $user->createToken('Riwaya')->accessToken;

            $success['user'] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'image' => $user->image,
            ];


            return response()->json(['success' => $success], 201, [], JSON_PRETTY_PRINT);


        } catch (ClientException $exception) {
            return response()->json([
                'error' => 'Invalid access token',
            ], 401);
        } catch (Exception $exception) {
            return response()->json([
                'error' => 'Something went wrong',
            ], 500);
        }

    }

    public function loginWithGoogle(Request $request)
    {
        return response()->json([
            'error' => $request->all(),
        ], 201);

        $user = User::firstOrCreate([
            'email' => $userData['email'],
        ], [
            'name' => $userData['name'],
            'password' => bcrypt(Str::random(16)),
            'provider_id' => $userData['sub'],
        ]);

        $success['token'] = $user->createToken('Riwaya')->accessToken;

        $success['user'] = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'image' => $user->image,
        ];

        return response()->json(['success' => $success], 201, [], JSON_PRETTY_PRINT);


    }


}
