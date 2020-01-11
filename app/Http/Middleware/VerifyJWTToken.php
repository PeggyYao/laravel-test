<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class VerifyJWTToken extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		try
		{
			if (!$user = JWTAuth::parseToken()->authenticate())
			{
				return response()->json(['message' => 'User not found'], 404);
			}
		}
		catch (Exception $e)
		{
			if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException)
			{
				return response()->json(['message' => 'Token is Invalid'], 401);
			}
			else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
			{
				return response()->json(['message' => 'Token is Expired'], 401);
			}
			else
			{
				return response()->json(['message' => 'Authorization Token not found'], 401);
			}
		}

		return $next($request);
    }
}
