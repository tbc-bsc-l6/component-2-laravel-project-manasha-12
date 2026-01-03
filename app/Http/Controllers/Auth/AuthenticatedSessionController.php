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
use App\Models\OldStudent;

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

        // Handle each role separately
        if ($role === 'admin') {
            return $this->attemptLogin(Admin::class, 'admin', 'admin.dashboard', $email, $password, $remember, $request);
        }

        if ($role === 'teacher') {
            return $this->attemptLogin(Teacher::class, 'teacher', 'teacher.dashboard', $email, $password, $remember, $request);
        }

        if ($role === 'student') {
            // ✅ Try active student first
            $student = Student::where('email', $email)->first();
            
            if ($student && Hash::check($password, $student->password)) {
                Auth::guard('student')->login($student, $remember);
                $request->session()->regenerate();
                
                return redirect()->intended(route('student.dashboard'))
                    ->with('success', "Welcome back, {$student->name}!");
            }

            // ✅ If active student fails, try old student (alumni)
            $oldStudent = OldStudent::where('email', $email)->first();
            
            if ($oldStudent && Hash::check($password, $oldStudent->password)) {
                Auth::guard('old_student')->login($oldStudent, $remember);
                $request->session()->regenerate();
                
                return redirect()->intended(route('student.dashboard'))
                    ->with('success', "Welcome back, {$oldStudent->name}! (Alumni)");
            }

            // If both fail, return error
            return back()
                ->withErrors(['email' => "No student account found with this email address or incorrect password."])
                ->onlyInput('email', 'role')
                ->with('error', 'Login failed: No student account exists with this email or incorrect password.');
        }

        return back()
            ->withErrors(['email' => 'Invalid role selected.'])
            ->onlyInput('email', 'role');
    }

    /**
     * Attempt to login a user
     */
    private function attemptLogin(
        string $modelClass, 
        string $guard, 
        string $dashboard, 
        string $email, 
        string $password, 
        bool $remember, 
        Request $request
    ): RedirectResponse {
        // Find user in the specific role table
        $user = $modelClass::where('email', $email)->first();

        // Check if user exists in this role's table
        if (!$user) {
            $roleName = ucfirst(str_replace('_', ' ', $guard));
            return back()
                ->withErrors(['email' => "No {$roleName} account found with this email address."])
                ->onlyInput('email', 'role')
                ->with('error', "Login failed: No {$roleName} account exists with this email.");
        }

        // Verify password
        if (!Hash::check($password, $user->password)) {
            return back()
                ->withErrors(['email' => 'The provided password is incorrect.'])
                ->onlyInput('email', 'role')
                ->with('error', 'Login failed: Incorrect password.');
        }

        // Login user with the correct guard
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