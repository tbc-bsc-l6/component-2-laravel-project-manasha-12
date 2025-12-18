<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsTeacher
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->guard('teacher')->check()) {
            abort(403, 'Unauthorized access - Teacher only');
        }

        return $next($request);
    }
}