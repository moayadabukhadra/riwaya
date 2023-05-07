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

        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook()
    {
        return Socialite::driver('facebook')->redirect();    }

}
