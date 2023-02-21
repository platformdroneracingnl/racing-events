<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /* Set new lang with the use of session */
        if (session()->has('lang')) {
            App::setLocale(session()->get('lang'));
        }

        return $next($request);
    }
}
