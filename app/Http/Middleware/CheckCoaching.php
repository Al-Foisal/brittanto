<?php

namespace App\Http\Middleware;

use Closure;

class CheckCoaching
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->type === 'coaching' || auth()->user()->type === 'kindergarten' || auth()->user()->type === 'school') {
            return $next($request);
        }
        auth()->logout();
        return redirect()->routr('login');
    }
}
