<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Providers\ApiResponseProvider as APIResponse;

class LoginController extends ApiBaseController
{
    /**
     * Login
     *
     * @param Request $request
     */
    public function login(Request $request){
        try {
            $credentials = $request->only(['email', 'password']);
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->error('Email or password wrong.', APIResponse::API_ERROR_CODE_AUTH_FAIL);
            }
            return response()->success(compact('token'));
        }
        catch (JWTException $exception){
            return response()->error('Could not make token', APIResponse::API_ERROR_CODE_AUTH_FAIL);
        }
        catch (\Exception $exception){
            return response()->error('Login error', APIResponse::API_ERROR_CODE_500);
        }
    }
}
