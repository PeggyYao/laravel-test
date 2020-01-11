<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function generateToken(Request $request)
    {
		$credentials = $request->only('email', 'password');

        try
		{
            if (!$token = JWTAuth::attempt($credentials))
			{
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
        }
		catch (JWTException $e)
		{
            return response()->json(['message' => 'Could not create token'], 500);
        }

        return response()->json(compact('token'), 200);
    }

    public function refreshToken()
    {
		$token = JWTAuth::getToken();

		if(!$token)
		{
			return response()->json(['message' => 'Token is Invalid'], 400);
		}

		try
		{
			$newToken = JWTAuth::refresh($token);
		}
		catch(JWTException $e)
		{
			return response()->json(['message' => 'Could not refresh token'], 500);
		}

		return response()->json(['token' => $newToken], 200);
	}
}