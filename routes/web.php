<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;


// Public route - Homepage
Route::get('/', function () {
    return view('welcome');
})-> name('welcome');

Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');

// Profile routes - accessible by ALL authenticated user types
Route::middleware(['auth:admin,teacher,student,old_student'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

// Registration Routes (Students Only)
Route::get('/register', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisterController::class, 'store'])
    ->middleware('guest');

// Email Verification Routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth:student')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth:student', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
    ->middleware(['auth:student', 'throttle:6,1'])
    ->name('verification.send');

// Admin Routes
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
        ->name('dashboard');

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

//Teacher Dashboard (Controller)
Route::middleware(['auth:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Teacher\DashboardController::class, 'index'])
        ->name('dashboard');

    // Modules
    Route::get('/modules', [App\Http\Controllers\Teacher\ModuleController::class, 'index'])
        ->name('modules.index');

    Route::get('/modules/{module}', [App\Http\Controllers\Teacher\ModuleController::class, 'show'])
        ->name('modules.show');

    // Grading
    Route::post(
        '/modules/{module}/enrollments/{enrollment}/grade',
        [App\Http\Controllers\Teacher\ModuleController::class, 'gradeStudent']
    )
        ->name('modules.grade-student');

    Route::post(
        '/modules/{module}/bulk-grade',
        [App\Http\Controllers\Teacher\ModuleController::class, 'bulkGrade']
    )
        ->name('modules.bulk-grade');

    Route::get('/grading', [App\Http\Controllers\Teacher\GradingController::class, 'index'])
        ->name('grading.index');

    Route::get('/grading/module/{module}', [App\Http\Controllers\Teacher\GradingController::class, 'showModule'])
        ->name('grading.module');

    Route::post('/grading/{enrollment}/grade', [App\Http\Controllers\Teacher\GradingController::class, 'grade'])
        ->name('grading.grade');

    Route::post('/grading/module/{module}/bulk-grade', [App\Http\Controllers\Teacher\GradingController::class, 'bulkGrade'])
        ->name('grading.bulk-grade');
});

// Student Routes (Both Student and Old Student)
Route::middleware(['auth:student,old_student'])->prefix('student')->name('student.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])
        ->name('dashboard');

    // Available Modules (Only for active students, not old students)
    Route::get('/modules/available', [App\Http\Controllers\Student\ModuleController::class, 'available'])
        ->name('modules.available')
        ->middleware('check.student.type:student'); // Only active students

    // Enroll in Module (Only for active students)
    Route::post('/modules/{module}/enroll', [App\Http\Controllers\Student\ModuleController::class, 'enroll'])
        ->name('modules.enroll')
        ->middleware('check.student.type:student'); // Only active students

    // My Current Modules (Active enrollments)
    Route::get('/modules/current', [App\Http\Controllers\Student\ModuleController::class, 'current'])
        ->name('modules.current')
        ->middleware('check.student.type:student'); // Only active students

    // Module History (Completed modules with PASS/FAIL)
    Route::get('/modules/history', [App\Http\Controllers\Student\ModuleController::class, 'history'])
        ->name('modules.history');

    // View specific module details
    Route::get('/modules/{module}', [App\Http\Controllers\Student\ModuleController::class, 'show'])
        ->name('modules.show');
});

// Auth routes (login, logout, etc.)
require __DIR__ . '/auth.php';
