<?php

/**
 * ----------------------------------------------------------------
 * Authenticate Middleware
 * ----------------------------------------------------------------
 *
 * This middleware is responsible for handling user authentication
 * in the application. It ensures that only authenticated users
 * can access certain routes. If a user is not authenticated, it
 * redirects them to the login page or returns an unauthorized
 * JSON response for API requests.
 *
 * Middleware is part of Laravel's request lifecycle and acts as
 * a filter before the request reaches your controllers.
 */

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware; // Base Laravel authentication middleware
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * ------------------------------------------------------------
     * Determine where to redirect unauthenticated users
     * ------------------------------------------------------------
     *
     * This method is called automatically by the parent
     * Authenticate middleware when a user is not logged in.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null  URL to redirect or null for JSON requests
     */
    protected function redirectTo(Request $request): ?string
    {
        // Check if the request expects a JSON response (API request)
        // If yes, return null so Laravel returns a 401 Unauthorized JSON response
        // If no, return the route to the login page
        return $request->expectsJson() ? null : route('login');
    }
}
