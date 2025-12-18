<?php

/**
 * ------------------------------------------------------------
 * ProfileController
 * ------------------------------------------------------------
 * 
 * This controller is responsible for:
 * - Displaying the authenticated user's profile edit page
 * - Updating profile information (name, email)
 * - Updating the user's password
 * 
 * It supports multiple user types using Laravel guards:
 * - Admin
 * - Teacher
 * - Student
 * - Old Student
 * 
 * The controller dynamically determines:
 * - Which user is currently authenticated
 * - Which database table should be used for validation
 * 
 * This keeps profile management centralized and reusable
 * across different user roles.
 */

namespace App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Model Imports
|--------------------------------------------------------------------------
| These models represent different authenticated user types.
| Each model is linked to its own authentication guard.
*/
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\OldStudent;

/*
|--------------------------------------------------------------------------
| Framework & Utility Imports
|--------------------------------------------------------------------------
*/
use Illuminate\Http\Request;                // Handles HTTP request data
use Illuminate\Support\Facades\Auth;         // Provides authentication helpers
use Illuminate\Support\Facades\Hash;         // Used for secure password hashing
use Illuminate\Validation\Rules\Password;   // Provides strong password rules
use Illuminate\Foundation\Auth\User as Authenticatable; // Base auth user class

class ProfileController extends Controller
{
    /**
     * --------------------------------------------------------
     * Show the profile edit page
     * --------------------------------------------------------
     * 
     * This method:
     * - Identifies the currently authenticated user
     * - Passes the user data to the profile edit view
     * 
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit', [
            // Make the authenticated user available in the Blade view as $user
            'user' => $this->getCurrentUser()
        ]);
    }

    /**
     * --------------------------------------------------------
     * Update basic profile information
     * --------------------------------------------------------
     * 
     * This method:
     * - Validates incoming name and email fields
     * - Ensures email uniqueness per user table
     * - Updates the authenticated user's profile data
     * 
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Retrieve the currently authenticated user
        $user = $this->getCurrentUser();
        
        // Validate incoming request data
        $validated = $request->validate([
            // Name must be present, a string, and within length limits
            'name' => ['required', 'string', 'max:255'],

            // Email must be unique within the user's table,
            // excluding the current user's own record
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:' . $this->getUserTable() . ',email,' . $user->id
            ],
        ]);

        // Mass-assign validated data to the user model
        $user->fill($validated);

        // Persist changes to the database
        $user->save();

        // Redirect back to the profile edit page with a status message
        return redirect()
            ->route('profile.edit')
            ->with('status', 'profile-updated');
    }

    /**
     * --------------------------------------------------------
     * Update user password
     * --------------------------------------------------------
     * 
     * This method:
     * - Verifies the current password
     * - Validates and confirms the new password
     * - Securely hashes and saves the new password
     * 
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        // Validate password inputs
        $validated = $request->validate([
            // Must match the user's existing password
            'current_password' => ['required', 'current_password'],

            // New password must follow default Laravel security rules
            // and be confirmed using password_confirmation
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // Retrieve the currently authenticated user
        $user = $this->getCurrentUser();
        
        // Hash the new password before saving
        $user->password = Hash::make($validated['password']);

        // Save the updated password to the database
        $user->save();

        // Redirect back with a success status message
        return back()->with('status', 'password-updated');
    }

    /**
     * --------------------------------------------------------
     * Get the currently authenticated user
     * --------------------------------------------------------
     * 
     * This method checks each authentication guard
     * and returns the authenticated user instance.
     * 
     * Guards checked:
     * - admin
     * - teacher
     * - student
     * - old_student
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
        
        // If no guard is authenticated, deny access
        abort(403, 'User not authenticated');
    }

    /**
     * --------------------------------------------------------
     * Get the database table name for the authenticated user
     * --------------------------------------------------------
     * 
     * This method is primarily used for validation rules,
     * especially for enforcing email uniqueness per user type.
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
        
        // Fallback (should not normally be reached)
        return 'users';
    }
}
