<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\UserManagementController;

// Public route - Homepage
Route::get('/', function () {
    return view('welcome');
});

// Profile routes - accessible by ALL authenticated user types
Route::middleware(['auth:admin,teacher,student,old_student'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

// Admin Dashboard
// Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
//     Route::get('/dashboard', function () {
//         return view('admin.dashboard');
//     })->name('dashboard');
// });
// Admin Routes
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        $stats = [
            'total_modules' => \App\Models\Module::count(),
            'active_modules' => \App\Models\Module::where('is_available', true)->count(),
            'total_teachers' => \App\Models\Teacher::count(),
            'total_students' => \App\Models\Student::count() + \App\Models\OldStudent::count(),
            'active_enrollments' => \App\Models\Enrollment::where('status', 'active')->count(),
        ];
        
        return view('admin.dashboard', compact('stats'));
    })->name('dashboard');

    // Module Management
    Route::resource('modules', ModuleController::class);
    Route::post('modules/{module}/toggle', [ModuleController::class, 'toggleAvailability'])
        ->name('modules.toggle');
    Route::post('modules/{module}/assign-teacher', [ModuleController::class, 'assignTeacher'])
        ->name('modules.assign-teacher');
    Route::delete('modules/{module}/teachers/{teacher}', [ModuleController::class, 'removeTeacher'])
        ->name('modules.remove-teacher');

    // Teacher Management
    Route::resource('teachers', TeacherController::class);

    // Enrollment Management
    Route::get('enrollments', [EnrollmentController::class, 'index'])
        ->name('enrollments.index');
    Route::delete('enrollments/{enrollment}', [EnrollmentController::class, 'destroy'])
        ->name('enrollments.destroy');
    Route::get('modules/{module}/enrollments', [EnrollmentController::class, 'moduleEnrollments'])
        ->name('modules.enrollments');

    // User Management
    Route::get('users', [UserManagementController::class, 'index'])
        ->name('users.index');
    Route::post('users/change-role', [UserManagementController::class, 'changeRole'])
        ->name('users.change-role');
});

// Teacher Dashboard
Route::middleware(['auth:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', function () {
        return view('teacher.dashboard');
    })->name('dashboard');
});

// Student Dashboard (for both students and old_students)
Route::middleware(['auth:student,old_student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', function () {
        return view('student.dashboard');
    })->name('dashboard');
});

// Auth routes (login, logout, etc.)
require __DIR__.'/auth.php';