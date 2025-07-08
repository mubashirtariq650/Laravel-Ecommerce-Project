<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (!Auth::check()) {
            // You can redirect to login or abort 403
            return redirect()->route('login');
        }

        return $next($request);
    }
}
