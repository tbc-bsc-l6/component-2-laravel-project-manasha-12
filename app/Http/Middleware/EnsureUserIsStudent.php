<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsStudent
{
    public function handle(Request $request, Closure $next): Response
    {
        $isStudent = auth()->guard('student')->check();
        $isOldStudent = auth()->guard('old_student')->check();

        if (!$isStudent && !$isOldStudent) {
            abort(403, 'Unauthorized access - Student only');
        }

        return $next($request);
    }
}