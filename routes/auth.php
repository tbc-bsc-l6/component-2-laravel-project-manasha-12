<?php

use App\Http\Controllers\Auth\MultiGuardLoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [MultiGuardLoginController::class, 'create'])
        ->name('login');

    Route::post('login', [MultiGuardLoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [MultiGuardLoginController::class, 'destroy'])
        ->name('logout');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});