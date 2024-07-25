<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            // Redirect to login if user is not authenticated
            return redirect('/login');
        }

        $user = Auth::user();

        // Check user role
        if ($user->role !== $role) {
            // Optionally, redirect to a forbidden page or home page
            return redirect('/forbidden');
        }

        return $next($request);
    }
}
