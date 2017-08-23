<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\ApiResponseProvider as APIResponse;
use JWTAuth;


class UserController extends ApiBaseController
{
    public function __construct()
    {
        //TODO
    }

    /**
     * Get profile
     * @return json object
     */
    public function profile(){
        try {
            $user = JWTAuth::parseToken()->toUser();
            return response()->success($user);
        }
        catch (\Exception $exception){
            return response()->error('Get profile error', APIResponse::API_ERROR_CODE_500);
        }
    }
}
