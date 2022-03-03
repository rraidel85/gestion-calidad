<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SetLoadedFromBrowserCacheCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if($response instanceof StreamedResponse){
            // If a file is downloaded dont send a cookie
            return $response;
        }

        return $response->withCookie(cookie()->forever(
            'loadedFromBrowserCache', 'false', httpOnly: false));

    }
}
