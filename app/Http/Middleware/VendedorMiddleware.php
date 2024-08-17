<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VendedorMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::user()->rol != "et_vendedor") {
            return redirect('/home');
        }

        return $next($request);
    }
}
