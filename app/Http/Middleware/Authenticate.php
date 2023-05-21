<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if($request->header('app_key') === 'TEKNIK_HIJAU'){
                abort(response()->json(
                    [
                        'status' => 'error',
                        'message' => 'UnAuthenticated'
                    ],
                    401
                ));
            }
            return route('login');
        }
    }

    // protected function unauthenticated($request, array $guards)
    // {
    //     // dd($request->all());
    //     if($request->header('app_key') === 'TEKNIK_HIJAU'){
    //         abort(response()->json(
    //             [
    //                 'status' => 'error',
    //                 'message' => 'UnAuthenticated'
    //             ],
    //             401
    //         ));
    //     }else{
    //         return route('login');
    //     }
    // }
}
