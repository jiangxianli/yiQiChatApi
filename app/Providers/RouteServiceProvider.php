<?php

namespace App\Providers;

use Dingo\Api\Routing\Router as ApiRouter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     * @param  \Dingo\Api\Routing\Router as ApiRouter $api
     *
     * @return void
     */
    public function map(Router $router, ApiRouter $api)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });

        $api->version('v1', function ($api) {
            $api->group(['namespace' => $this->namespace], function ($api) {
                require app_path('Http/Routes/customer.php');
                require app_path('Http/Routes/friend.php');
                require app_path('Http/Routes/message.php');
                require app_path('Http/Routes/image.php');
                require app_path('Http/Routes/mood.php');
            });

        });
    }
}
