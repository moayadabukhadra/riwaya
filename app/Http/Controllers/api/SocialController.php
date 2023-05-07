<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Auth;
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
        header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

        return Socialite::driver('facebook')->stateless()->user();
    }

}
