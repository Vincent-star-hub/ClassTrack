<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsTeacher
{
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->role !== 'teacher') {
            return abort(403, 'You do not have teacher access.');
        }

        return $next($request);
    }
}
