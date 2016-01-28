<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AuthenticateEdit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            return redirect()->guest('/auth');
        }

        if (!Auth::guard($guard)->user()->isActive()) {
            Auth::logout();
            return redirect()->guest('/unauth');
        }

        if (!Auth::guard($guard)->user()->canRead()) {
            Auth::logout();
            return redirect()->guest('/unauth');
        }

        if (!Auth::guard($guard)->user()->canWrite()) {
            return redirect('/');
        }

        return $next($request);
    }
}
