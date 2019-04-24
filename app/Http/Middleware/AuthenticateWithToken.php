<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthenticateWithToken
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
        $accessToken = $request->input('access_token', $request->header('Authorization'));

        if ($accessToken == null) {
            throw new UnauthorizedHttpException('', trans('api.access_token.required'));
        }

        if (!Cache::has("access_tokens.{$accessToken}")) {
            throw new UnauthorizedHttpException('', trans('api.access_token.invalid'));
        }
        
        return $next($request);
    }
}
