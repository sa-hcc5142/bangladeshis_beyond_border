<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * LAB CONCEPT: Middleware - Role-based Access Control
     * Authors can post blogs and reply to comments.
     * Admins also have author permissions (can do everything authors can).
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Please login to access this page.');
        }

        // Allow both admin and author roles
        if (!auth()->user()->isAdmin() && !auth()->user()->isAuthor()) {
            abort(403, 'Unauthorized. Author or Admin access required.');
        }

        return $next($request);
    }
}
