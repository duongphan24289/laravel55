<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ApiResponseProvider extends ServiceProvider
{
    const API_TOKEN_NOT_PROVIDED = 400;
    const API_TOKEN_EXPIRED = 401;
    const API_TOKEN_INVALID = 402;
    const API_ERROR_CODE_AUTH_FAIL = 300;
    const API_ERROR_CODE_500 = 500;
    const ERROR_CODE_NOT_FOUND = 404;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Response success
         */
        Response::macro('success', function ($data, $status = 0) {
            return Response::json([
                'status' => true,
                'data'   => $data,
                'error'  => [
                    'code'    => $status,
                    'message' => []
                ]
            ]);
        });

        /**
         * Response errors
         */
        Response::macro('error', function ($message, $status = 400, $data = null) {
            return Response::json([
                'status' => false,
                'data'   => $data,
                'error'  => [
                    'code'    => $status,
                    'message' => $message
                ]
            ]);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
