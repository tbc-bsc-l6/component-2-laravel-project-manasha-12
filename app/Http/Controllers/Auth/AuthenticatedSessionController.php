<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
        // Validate input
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'role' => ['required', 'in:admin,teacher,student'],
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $role = $request->input('role');
        $remember = $request->boolean('remember');

        // Determine which model and guard to use based on role
        $modelMap = [
            'admin' => [Admin::class, 'admin', 'admin.dashboard'],
            'teacher' => [Teacher::class, 'teacher', 'teacher.dashboard'],
            'student' => [Student::class, 'student', 'student.dashboard'],
        ];

        [$modelClass, $guard, $dashboard] = $modelMap[$role];

        // Find user in the SPECIFIC role table
        $user = $modelClass::where('email', $email)->first();

        // Check if user exists in this role's table
        if (!$user) {
            return back()
                ->withErrors(['email' => "No {$role} account found with this email address."])
                ->onlyInput('email', 'role')
                ->with('error', "Login failed: No {$role} account exists with this email.");
        }

        // Verify password
        if (!Hash::check($password, $user->password)) {
            return back()
                ->withErrors(['email' => 'The provided password is incorrect.'])
                ->onlyInput('email', 'role')
                ->with('error', 'Login failed: Incorrect password.');
        }

        // Login user with the CORRECT guard
        Auth::guard($guard)->login($user, $remember);
        $request->session()->regenerate();

        // Redirect to the correct dashboard
        return redirect()->intended(route($dashboard))
            ->with('success', "Welcome back, {$user->name}!");
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Logout from all guards
        Auth::guard('admin')->logout();
        Auth::guard('teacher')->logout();
        Auth::guard('student')->logout();
        Auth::guard('old_student')->logout();
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'You have been logged out successfully.');
    }
}