<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\TwoFactorAuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

// Test route
Route::get('/test', function() {
    return 'Laravel is working!';
});

// Authentication Routes
Route::middleware(['guest', 'throttle:5,1'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); // Logout requires authentication, handled separately

// Two-Factor Authentication Routes
Route::middleware(['auth', 'throttle:5,1'])->group(function () {
    Route::get('/2fa/verify', [TwoFactorAuthController::class, 'showVerificationForm'])
        ->name('2fa.verify');
        
    Route::post('/2fa/verify', [TwoFactorAuthController::class, 'verify']);

    // Recovery code routes
    Route::get('/2fa/recovery', [TwoFactorAuthController::class, 'showRecoveryCodes'])
        ->name('2fa.recovery');
        
    Route::post('/2fa/recovery/generate', [TwoFactorAuthController::class, 'generateNewRecoveryCodes'])
        ->name('2fa.generate');
});

// Legacy endpoint proxy
Route::get('/endpoints/db/migrate.php', function() {
    require_once base_path('../endpoints/db/migrate.php');
    return response('');
});
