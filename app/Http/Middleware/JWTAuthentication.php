<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Middleware\BaseMiddleware;
use App\Providers\ApiResponseProvider as APIResponse;

class JWTAuthentication extends BaseMiddleware
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
        if(!$token = $this->auth->setRequest($request)->getToken()){
            return response()->error('Token not provided.', APIResponse::API_TOKEN_NOT_PROVIDED);
        }
        try {
            $user = $this->auth->authenticate($token);
        }
        catch (TokenExpiredException $exception){
            return response()->error('Token is expired.', APIResponse::API_TOKEN_EXPIRED);
        }
        catch (JWTException $exception){
            return response()->error('Token not invalid.', APIResponse::API_TOKEN_INVALID);
        }

        if (! $user) {
            return response()->error('User is not found.', APIResponse::ERROR_CODE_NOT_FOUND);
        }

        $this->events->fire('tymon.jwt.valid', $user);

        return $next($request);
    }
}
