<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->role !== 'admin') {
            return abort(403, 'You do not have admin access.');
        }

        return $next($request);
    }
}
