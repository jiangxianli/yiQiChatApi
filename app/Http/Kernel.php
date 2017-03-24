<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Clockwork\Support\Laravel\ClockworkMiddleware::class,
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        //        \App\Http\Middleware\VerifyCsrfToken::class,
        \App\Http\Middleware\ApiResponseHeader::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'          => \App\Http\Middleware\Authenticate::class,
        'auth.basic'    => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.token'    => \App\Http\Middleware\AuthenticateWithToken::class,
        'guest'         => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'auth.customer' => \App\Http\Middleware\CustomerAuthenticate::class,
    ];
}
