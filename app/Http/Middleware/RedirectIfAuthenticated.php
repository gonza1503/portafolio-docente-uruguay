<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Maneja una solicitud entrante.
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}