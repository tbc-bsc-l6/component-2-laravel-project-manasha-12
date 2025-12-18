<?php

/**
 * ----------------------------------------------------------------
 * EnsureUserIsAdmin Middleware
 * ----------------------------------------------------------------
 *
 * This middleware is responsible for restricting access to routes
 * that should only be accessible by authenticated admin users.
 * 
 * It checks if the current user is logged in via the 'admin' guard.
 * If not, it aborts the request with a 403 Forbidden response.
 *
 * Middleware in Laravel acts as a filter that runs **before** the
 * request reaches the controller.
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * ------------------------------------------------------------
     * Handle an incoming request
     * ------------------------------------------------------------
     *
     * This method is automatically called by Laravel before the
     * request reaches the controller.
     *
     * @param  \Illuminate\Http\Request  $request  The incoming HTTP request
     * @param  \Closure  $next  Closure representing the next step in the request lifecycle
     * @return \Symfony\Component\HttpFoundation\Response  The HTTP response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the current user is authenticated using the 'admin' guard
        // auth()->guard('admin')->check() returns true if an admin is logged in
        if (!auth()->guard('admin')->check()) {
            // If user is NOT an admin, terminate the request
            // Return a 403 Forbidden HTTP response with a custom message
            abort(403, 'Unauthorized access - Admin only');
        }

        // If user is an admin, allow the request to proceed to the next middleware or controller
        return $next($request);
    }
}
