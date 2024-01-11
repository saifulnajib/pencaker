<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use Validator;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ApiController;

class AuthController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth.jwt', ['except' => ['login', 'register']]);
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'group_id' => 'required|numeric'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $user_id = $user->id;
        $group = ['user_id'=>$user_id,'group_id'=>$input['group_id']];
        $userGroup = UserGroup::create($group);

        return $this->sendResponse($user, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['access_token'] = JWTAuth::fromUser($user);
            $success['token_type'] =  "bearer";
            $success['expires_in'] = auth('api')->factory()->getTTL() * 60;
            activity()->event('logged in')->log('Pengguna masuk');
            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised'], 400);
        }
    }

    /**
     * UserInfo api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userInfo(): JsonResponse
    {
        $user = auth()->user();
        return $this->sendResponse($user, 'User data retrieved successfully.');
    }

    /**
     * Logout api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        activity()->event('logged in')->log('Pengguna keluar');
        return $this->sendResponse([], 'User logged out successfully.');
    }
}
