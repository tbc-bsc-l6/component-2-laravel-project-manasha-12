<?php

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
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $email = $request->email;
        $password = $request->password;
        $remember = $request->boolean('remember');

        // Try to find user in each table and authenticate
        
        // 1. Check Admins
        $admin = Admin::where('email', $email)->first();
        if ($admin && Hash::check($password, $admin->password)) {
            Auth::guard('admin')->login($admin, $remember);
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        // 2. Check Teachers
        $teacher = Teacher::where('email', $email)->first();
        if ($teacher && Hash::check($password, $teacher->password)) {
            Auth::guard('teacher')->login($teacher, $remember);
            $request->session()->regenerate();
            return redirect()->intended('/teacher/dashboard');
        }

        // 3. Check Students
        $student = Student::where('email', $email)->first();
        if ($student && Hash::check($password, $student->password)) {
            Auth::guard('student')->login($student, $remember);
            $request->session()->regenerate();
            return redirect()->intended('/student/dashboard');
        }

        // 4. Check Old Students
        $oldStudent = OldStudent::where('email', $email)->first();
        if ($oldStudent && Hash::check($password, $oldStudent->password)) {
            Auth::guard('old_student')->login($oldStudent, $remember);
            $request->session()->regenerate();
            return redirect()->intended('/student/dashboard');
        }

        // If no match found
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function destroy(Request $request)
    {
        // Logout from all guards
        Auth::guard('admin')->logout();
        Auth::guard('teacher')->logout();
        Auth::guard('student')->logout();
        Auth::guard('old_student')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}