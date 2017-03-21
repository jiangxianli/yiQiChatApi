<?php

namespace App\Http\Middleware;


use Closure;

use App\Models\Customer;

class CustomerAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        app('config')->set('auth.model', Customer::class);
        app('config')->set('jwt.user', 'App\Models\Customer');

        return $next($request);
    }
}
