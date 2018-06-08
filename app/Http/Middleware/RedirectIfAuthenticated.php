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
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }
        /* if ($this->auth->check() && $this->auth->user()->isAdmin())
        {
            return redirect()->route('users.index');
        }
    
        // If the user is authenticated we redirect them to the normal 
        // dashboard page or initial page. 
        if ($this->auth->check()) {
            return redirect('/');
        } */

        return $next($request);
    }
}
