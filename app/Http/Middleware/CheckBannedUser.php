<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBannedUser
{
    /**
     * Handle an incoming request.
     *
     * LAB CONCEPT: Middleware - Business Logic Enforcement
     * Checks if user has 3 or more warnings (banned).
     * Banned users cannot post comments.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->isBanned()) {
            auth()->logout();
            return redirect()->route('login')
                ->with('error', 'Your account has been banned due to 3 inappropriate comments. Please contact admin.');
        }

        return $next($request);
    }
}
