<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckStudentType
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $type)
    {
        // Check if user is authenticated as the correct student type
        if ($type === 'student' && !Auth::guard('student')->check()) {
            return redirect()->route('student.dashboard')
                ->with('error', 'This feature is only available for active students.');
        }

        if ($type === 'old_student' && !Auth::guard('old_student')->check()) {
            return redirect()->route('student.dashboard')
                ->with('error', 'Access denied.');
        }

        return $next($request);
    }
}