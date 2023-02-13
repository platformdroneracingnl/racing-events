<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckSuspended
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->suspended_until && now()->lessThan(auth()->user()->suspended_until)) {
            $suspended_days = now()->diffInDays(auth()->user()->suspended_until);
            auth()->logout();

            if ($suspended_days > 14) {
                $message = 'Your account has been suspended. For more information, please contact one of the administrators.';
            } else {
                $message = 'Your account has been suspended for '.$suspended_days.' '.Str::plural('day', $suspended_days).'. For more information, please contact one of the administrators.';
            }

            return redirect()->route('login')->withMessage($message);
        }

        return $next($request);
    }
}
