<?php namespace App\Http\Middleware;

use Closure;

class ApiResponseHeader
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
        // 参考内容
        // http://stackoverflow.com/questions/14414896/laravel-handling-the-option-http-method-request
        // https://laracasts.com/discuss/channels/requests/laravel-5-cors-headers-with-filters?page=2
        return $next($request)
            ->header('Access-Control-Allow-Origin', $request->header('Origin'))
            ->header('Access-Control-Allow-Credentials', 'true')
            ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With');
    }

}
