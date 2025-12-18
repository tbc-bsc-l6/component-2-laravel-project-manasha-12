<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
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