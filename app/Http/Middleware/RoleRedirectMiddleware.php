<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class RoleRedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

         // Admin can access everything
        if ($user->hasRole('Admin')) {
            return $next($request);
        }
        // If user has the correct role → allow access
        if ($user && $user->hasRole($role)) {
            return $next($request);
        }
            // Custom redirect logic
        if ($user && $user->hasRole('Investor')) {
            return redirect('/investor/dashboard');
        }       

        // Default fallback
        return redirect('/');
    }
}
