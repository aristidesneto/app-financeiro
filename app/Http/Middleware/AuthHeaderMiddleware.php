<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthHeaderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->bearerToken()) {
            if ($request->hasCookie('_token')) {
                $token = $request->cookie('_token');
                $request->headers->add([
                    'Authorization' => 'Bearer ' . $token,
                ]);
            }
        }

        return $next($request);
    }
}
