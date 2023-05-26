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

            $success['token'] = $user->createToken('Riwaya')->accessToken;

            $success['user'] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'image' => $user->image,
                'role' => $user->roles()->first()?->name,
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
        $success['user'] = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'image' => $user->image,
            'role' => $user->roles()->first()?->name,
        ];
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

    function favoriteBooks(Request $request)
    {
        $user = \auth('api')->user();
        $paginate = $request->get('paginate') ?? 8;
        $favoriteBooks = $user->favoriteBooks()->with(['image', 'author', 'category'])->paginate($paginate);

        return response()->json(['success' => $favoriteBooks], $this->successStatus);
    }

    function addToFavoriteBooks(Request $request)
    {
        $user = \auth('api')->user();
        $user->favoriteBooks()->attach($request->get('book'));
        return response()->json(['success' => 'تم الاضافة الى المفضلة'], $this->successStatus);
    }

    public function editProfileImage(Request $request){
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorised'], 401);
        }

        $request->validate([
              'image'=>'mimes:jpeg,png,jpg,gif,svg'
          ]);

        $user->image()->delete();
        $user->saveImage($request->file('image'));

        return response()->json([
            'success' => 'تم تعديل الصورة الشخصية',
            'imagePath'=>$user->image()->path
        ], $this->successStatus);

    }


    public function editProfile(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required' => 'يجب ادخال الاسم',
            'email.required' => 'يجب ادخال البريد الالكتروني',
            'email.email' => 'يجب ادخال البريد الالكتروني بشكل صحيح',
            'email.unique' => 'هذا البريد الالكتروني موجود مسبقا',
        ]);

        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ]);

        if ($request->get('remove_image')) {
            $user->image()->delete();
        }
        if ($request->hasFile('image')) {
            $user->image()?->delete();
            $user->saveImage($request->file('image'));
        }

        $success['token'] = $user->createToken('Riwaya')->accessToken;
        $success['user'] = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'image' => $user->image,
            'role' => $user->roles()->first()?->name,
        ];


        return response()->json(['success' => $success], $this->successStatus);

    }
}
