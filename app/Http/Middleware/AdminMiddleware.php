<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::user()->rol != "et_admin") {
            return redirect('/home');
        }

        return $next($request);
    }
}
