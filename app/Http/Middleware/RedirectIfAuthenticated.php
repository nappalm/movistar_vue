<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if($guard == "embajador" && Auth::guard($guard)->check()){
            return redirect('/home');
        }

        if($guard == "experto" && Auth::guard($guard)->check()){
            return redirect('/home');
        }

        if($guard == "administrador" && Auth::guard($guard)->check()){
            return redirect('/home');
        }

        if (Auth::guard($guard)->check()) {
            return redirect('/login');
        }

        return $next($request);
    }
}
