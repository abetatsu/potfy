<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected $company_route = 'company.login';
    protected $user_route = 'user.login';
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (Route::is('user.*') || Route::is('users.*')) {
                return route($this->user_route);
            } elseif (Route::is('company.*')) {
                return route($this->company_route);
            }
        }
    }
}
