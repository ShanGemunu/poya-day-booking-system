<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * get access level for assign previllages to token 
     *
     * @param  string  $userType
     * @return string
     */
    private static function getAccesLevel(string $userType)
    {
        if($userType === 'user'){
            return 'userAccess';
        }else{
            return 'adminAccess';
        }
    }

    /**
     * login 
     *
     * @param  Request  $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // exits:users,email    checks if provided email exits in users table email column
        $request->validate([
            'email' => ['required', 'email','exists:users,email'],
            'password' => ['required']
        ]);

        $user = User::where('email', $request->email)->first();

        if (Hash::check($request->password,$user->password)) {

            $userAccessLevel = self::getAccesLevel($user->user_type);

            // createToken() method calls on App\Models\User
            $token = $user->createToken('bearer_token',[$userAccessLevel], now()->addHour());

            return [
                'access-token' => $token->plainTextToken
            ];
        }

        return response()->json([
            'error' => 'password wrong'
        ], 401);
    }

     /**
     * logout
     *
     * @param  Request  $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'user logged out'
        ],200);
    }
}
