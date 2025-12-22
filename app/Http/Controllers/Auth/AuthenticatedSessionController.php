<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Student;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'role' => ['required', 'in:admin,teacher,student'],
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');
        $role = $request->input('role');
        $email = $request->input('email');

        // Check if user exists in the correct table
        $user = null;
        $guard = null;

        switch ($role) {
            case 'admin':
                $user = Admin::where('email', $email)->first();
                $guard = 'admin';
                break;
            case 'teacher':
                $user = Teacher::where('email', $email)->first();
                $guard = 'teacher';
                break;
            case 'student':
                $user = Student::where('email', $email)->first();
                $guard = 'web';
                break;
        }

        // If user doesn't exist in the selected role table
        if (!$user) {
            return back()->withErrors([
                'email' => "No {$role} account found with this email address.",
            ])->onlyInput('email', 'role');
        }

        // Verify password
        if (!Hash::check($request->input('password'), $user->password)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email', 'role');
        }

        // Attempt to authenticate with the appropriate guard
        if (Auth::guard($guard)->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Redirect based on role
            return match($role) {
                'admin' => redirect()->intended(route('admin.dashboard')),
                'teacher' => redirect()->intended(route('teacher.dashboard')),
                'student' => redirect()->intended(route('dashboard')),
            };
        }

        return back()->withErrors([
            'email' => 'Authentication failed. Please try again.',
        ])->onlyInput('email', 'role');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Determine which guard to logout from
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('teacher')->check()) {
            Auth::guard('teacher')->logout();
        } else {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}