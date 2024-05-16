<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * Kullanıcı giriş işlemi
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }

            $user = JWTAuth::user();
            $role = $user->role;

            if($role != "admin"){
                return response()->json(['error' => 'permission_error'], 401);
            }

        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    /**
     * Kullanıcı token yenileme
     *
     * @return \Illuminate\Http\Response
     */
    public function refresh()
    {
        try {
            $token = JWTAuth::parseToken()->refresh();
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_refresh_token'], 500);
        }

        return response()->json(compact('token'));
    }

    /**
     * Kullanıcı çıkış işlemi
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        try {
            JWTAuth::invalidate();
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_invalidate_token'], 500);
        }

        return response()->json(['message' => 'Logged out successfully']);
    }
}
