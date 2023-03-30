<?php


namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public int $successStatus = 200;

    /**
     * login api
     *
     * @return JsonResponse
     */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyLaravelApp')->accessToken;
            $success['user'] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'image' => $user->image,
                'role' => $user->roles()->first()?->name,
                'token' => $success['token'],
            ];
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    /**
     * Register api
     *
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $user->assignRole('user');
        $success['token'] = $user->createToken('Riwaya')->accessToken;
        $success['user'] = $user->load(['image', 'roles']);
        return response()->json(['success' => $success], $this->successStatus);
    }

    /**
     * details api
     *
     * @return JsonResponse
     */
    public function userRole()
    {
        $user = \auth('api')->user();
        return response()->json(['success' => $user->roles()->first()->name], $this->successStatus);

    }

    function favoriteBooks()
    {
        $user = \auth('api')->user();
        return response()->json(['success' => $user->favoriteBooks()->with(['image','author','category'])->get()], $this->successStatus);
    }

    function addToFavoriteBooks(Request $request)
    {

        $user = Auth::user();
        $user->favoriteBooks()->attach($request->get('book'));
        return response()->json(['success' => 'تم الاضافة الى المفضلة'], $this->successStatus);
    }


}
