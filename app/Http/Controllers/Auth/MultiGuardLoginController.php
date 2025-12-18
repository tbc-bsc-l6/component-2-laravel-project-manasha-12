<?php

/**
 * ----------------------------------------------------------------
 * MultiGuardLoginController
 * ----------------------------------------------------------------
 *
 * Handles authentication for multiple user types (guards):
 * - Admin
 * - Teacher
 * - Student
 * - Old Student
 *
 * Responsibilities:
 * 1. Display the login form
 * 2. Process login attempts across all user types
 * 3. Handle logout from all guards
 *
 * This controller centralizes login logic for multi-auth Laravel apps,
 * ensuring correct guard usage and session management.
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\OldStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MultiGuardLoginController extends Controller
{
    /**
     * ------------------------------------------------------------
     * Show the login page
     * ------------------------------------------------------------
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Return the login Blade view (resources/views/auth/login.blade.php)
        return view('auth.login');
    }

    /**
     * ------------------------------------------------------------
     * Handle login attempt
     * ------------------------------------------------------------
     * 
     * This method:
     * - Validates incoming login data
     * - Attempts authentication across multiple guards
     * - Regenerates the session upon successful login
     * - Redirects the user to the intended dashboard based on their role
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 1️ Validate login input
        // Ensure 'email' and 'password' fields are present and valid
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2️ Extract login credentials from the request
        $email = $request->email;                 // Email entered by user
        $password = $request->password;           // Password entered by user
        $remember = $request->boolean('remember'); // "Remember me" checkbox

        // -----------------------------------------------------------------
        // 3️ Attempt authentication for each user type in order of priority
        // -----------------------------------------------------------------

        // ---------- Check Admins ----------
        $admin = Admin::where('email', $email)->first(); // Find admin by email
        if ($admin && Hash::check($password, $admin->password)) {
            // Login admin using the 'admin' guard
            Auth::guard('admin')->login($admin, $remember);

            // Regenerate session ID to prevent session fixation attacks
            $request->session()->regenerate();

            // Redirect to admin dashboard (or intended page if redirected previously)
            return redirect()->intended('/admin/dashboard');
        }

        // ---------- Check Teachers ----------
        $teacher = Teacher::where('email', $email)->first(); // Find teacher by email
        if ($teacher && Hash::check($password, $teacher->password)) {
            // Login teacher using the 'teacher' guard
            Auth::guard('teacher')->login($teacher, $remember);
            $request->session()->regenerate(); // Regenerate session
            return redirect()->intended('/teacher/dashboard');
        }

        // ---------- Check Students ----------
        $student = Student::where('email', $email)->first(); // Find student by email
        if ($student && Hash::check($password, $student->password)) {
            // Login student using the 'student' guard
            Auth::guard('student')->login($student, $remember);
            $request->session()->regenerate(); // Regenerate session
            return redirect()->intended('/student/dashboard');
        }

        // ---------- Check Old Students ----------
        $oldStudent = OldStudent::where('email', $email)->first(); // Find old student by email
        if ($oldStudent && Hash::check($password, $oldStudent->password)) {
            // Login old student using the 'old_student' guard
            Auth::guard('old_student')->login($oldStudent, $remember);
            $request->session()->regenerate(); // Regenerate session
            return redirect()->intended('/student/dashboard');
        }

        // ---------- If no match is found ----------
        // Return back to login page with an error message
        // Only repopulate the 'email' input field for user convenience
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * ------------------------------------------------------------
     * Logout user from all guards
     * ------------------------------------------------------------
     * 
     * This method:
     * - Logs out the user from all guards
     * - Invalidates the session
     * - Regenerates CSRF token to prevent session fixation attacks
     * - Redirects to homepage
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        // Logout from all defined guards to ensure complete logout
        Auth::guard('admin')->logout();
        Auth::guard('teacher')->logout();
        Auth::guard('student')->logout();
        Auth::guard('old_student')->logout();

        // Invalidate the entire session
        $request->session()->invalidate();

        // Regenerate CSRF token for security
        $request->session()->regenerateToken();

        // Redirect to homepage
        return redirect('/');
    }
}
