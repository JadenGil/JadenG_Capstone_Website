<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\SettingsController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Password confirmation routes
Route::get('/confirm-password', [ConfirmPasswordController::class, 'showConfirmForm'])
    ->middleware('auth')
    ->name('password.confirm');
    
Route::post('/confirm-password', [ConfirmPasswordController::class, 'confirm'])
    ->middleware('auth');

// Settings routes
Route::get('/settings/security', [SettingsController::class, 'security'])
    ->middleware(['auth', 'verified', 'password.confirm'])
    ->name('settings.security');
    
Route::post('/update-password', [SettingsController::class, 'updatePassword'])
    ->middleware(['auth', 'verified', 'password.confirm'])
    ->name('settings.update-password');

// Email verification routes
Route::get('/email/verify', function () {
    return view('livewire.pages.auth.verify-email'); // Updated path for Livewire/Volt component
})->middleware('auth')->name('verification.notice');
    
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('dashboard')->with('status', 'Your email has been verified!');
})->middleware(['auth', 'signed'])->name('verification.verify');
    
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

require __DIR__.'/auth.php';