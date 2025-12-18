<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\OldStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', [
            'user' => $this->getCurrentUser()
        ]);
    }

    public function update(Request $request)
    {
        $user = $this->getCurrentUser();
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:' . $this->getUserTable() . ',email,' . $user->id],
        ]);

        // Use fill and save instead of update to avoid IntelliSense issues
        $user->fill($validated);
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user = $this->getCurrentUser();
        
        // Use direct property assignment to avoid IntelliSense issues
        $user->password = Hash::make($validated['password']);
        $user->save();

        return back()->with('status', 'password-updated');
    }

    /**
     * Get the currently authenticated user
     * 
     * @return Admin|Teacher|Student|OldStudent
     */
    private function getCurrentUser(): Authenticatable
    {
        if (Auth::guard('admin')->check()) {
            return Auth::guard('admin')->user();
        }
        
        if (Auth::guard('teacher')->check()) {
            return Auth::guard('teacher')->user();
        }
        
        if (Auth::guard('student')->check()) {
            return Auth::guard('student')->user();
        }
        
        if (Auth::guard('old_student')->check()) {
            return Auth::guard('old_student')->user();
        }
        
        abort(403, 'User not authenticated');
    }

    /**
     * Get the database table name for the current user
     * 
     * @return string
     */
    private function getUserTable(): string
    {
        if (Auth::guard('admin')->check()) {
            return 'admins';
        }
        
        if (Auth::guard('teacher')->check()) {
            return 'teachers';
        }
        
        if (Auth::guard('student')->check()) {
            return 'students';
        }
        
        if (Auth::guard('old_student')->check()) {
            return 'old_students';
        }
        
        return 'users';
    }
}