<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{

    public function loginWithFacebook(Request $request)
    {
        $accessToken = $request->get('accessToken');

        try {
            $user = Socialite::driver('facebook')->userFromToken($accessToken);


            $image = Image::make($user->avatar_original);

            $extension = explode('/', $image->mime())[1];

            $img_name = Str::random(10) . '.' . $extension;


            $image->insert(public_path('/assets/images/water-mark.png'), 'bottom-right', 10, 10)
                ->save(storage_path('app/public/images/' . $img_name));

            $user = User::firstOrCreate([
                'email' => $user->email,
            ], [
                'name' => $user->name,
                'password' => bcrypt(Str::random(16)),
                'provider_id' => $user->id,
            ]);


            $user->image()->create(
                [
                    'name' => $user->name,
                    'path' => $img_name,
                ]
            );


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

        $userData = $request->all();

        $user = User::firstOrCreate([
            'email' => $userData['email'],
        ], [
            'name' => $userData['name'],
            'password' => bcrypt(Str::random(16)),
            'provider_id' => $userData['sub'],
        ]);

        $image = Image::make($userData['picture']);

        $extension = explode('/', $image->mime())[1];

        $img_name = Str::random(10) . '.' . $extension;

        $image->save(public_path('images/users/' . $img_name));

        $image->insert(public_path('/assets/images/water-mark.png'), 'bottom-right', 10, 10)
            ->save(storage_path('app/public/images/' . $img_name));

        $user->image()->create(
            [
                'name' => $userData['name'],
                'path' => $img_name,
            ]
        );


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
