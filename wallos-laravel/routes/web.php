<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\TwoFactorAuthController;

/**
 * Main application routes
 * 
 * @package Wallos
 * @group Application
 */

// ==================== PUBLIC ROUTES ====================
Route::middleware(['web'])->group(function () {
    /**
     * Application home page
     * @return \Illuminate\View\View
     */
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    /**
     * Test route - verify Laravel is working
     * @return string
     */
    Route::get('/test', function() {
        return 'Laravel is working!';
    })->name('test');
});

// ==================== AUTHENTICATION ROUTES ====================
Route::middleware(['web', 'guest', 'throttle:5,1'])->group(function () {
    // Password reset routes
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('auth.password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('auth.password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])
        ->name('auth.password.update');

    /**
     * Show login form
     * @return \Illuminate\View\View
     */
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('auth.login');

    /**
     * Handle login request
     * @return \Illuminate\Http\RedirectResponse
     */
    Route::post('/login', [LoginController::class, 'login']);

    /**
     * Show registration form
     * @return \Illuminate\View\View
     */
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
        ->name('auth.register');

    /**
     * Handle registration request
     * @return \Illuminate\Http\RedirectResponse
     */
    Route::post('/register', [RegisterController::class, 'register']);
});

// Logout requires separate middleware group
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('web')
    ->name('auth.logout');

// ==================== AUTHENTICATED ROUTES ====================
Route::middleware(['web', 'auth', 'verified'])->group(function () {
    /**
     * Dashboard home
     * @return \Illuminate\View\View
     */
    Route::get('/home', function () {
        return view('home');
    })->name('dashboard');
    
    /**
     * Subscription routes
     */
    Route::resource('subscriptions', \App\Http\Controllers\SubscriptionController::class);
    
    /**
     * Profile routes
     */
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile.edit');
    
    Route::put('/profile', function () {
        // Placeholder for profile update logic
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    })->name('profile.update');
    
    /**
     * Settings routes
     */
    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');
    
    Route::post('/settings/display', function () {
        // Placeholder for display settings update logic
        return redirect()->route('settings')->with('display_success', 'Display settings updated successfully!');
    })->name('settings.display');
    
    Route::post('/settings/currency', function () {
        // Placeholder for currency settings update logic
        return redirect()->route('settings')->with('currency_success', 'Currency settings updated successfully!');
    })->name('settings.currency');
    
    Route::post('/settings/language', function () {
        // Placeholder for language settings update logic
        return redirect()->route('settings')->with('language_success', 'Language settings updated successfully!');
    })->name('settings.language');
});

// ==================== 2FA ROUTES ====================
Route::middleware(['web', 'auth', 'throttle:5,1'])->group(function () {
    /**
     * Show 2FA verification form
     * @return \Illuminate\View\View
     */
    Route::get('/2fa/verify', [TwoFactorAuthController::class, 'showVerificationForm'])
        ->name('auth.2fa.verify');
        
    /**
     * Verify 2FA code
     * @return \Illuminate\Http\RedirectResponse
     */
    Route::post('/2fa/verify', [TwoFactorAuthController::class, 'verify']);

    // Recovery code routes
    Route::get('/2fa/recovery', [TwoFactorAuthController::class, 'showRecoveryCodes'])
        ->name('auth.2fa.recovery');
        
    Route::post('/2fa/recovery/generate', [TwoFactorAuthController::class, 'generateNewRecoveryCodes'])
        ->name('auth.2fa.generate');
});

// ==================== LEGACY ENDPOINTS ====================
Route::prefix('legacy')->middleware(['web', 'throttle:3,1'])->group(function () {
    /**
     * @deprecated Will be removed in v2.0 - Migrate to new API endpoints
     * @group Legacy System
     * @title Database Migration Proxy
     * @description Temporary bridge for legacy migration system
     */
    Route::get('/db/migrate', function() {
        try {
            $originalDir = getcwd();
            chdir(base_path('../'));
            
            ob_start();
            require_once 'endpoints/db/migrate.php';
            $output = ob_get_clean();
            
            chdir($originalDir);
            
            return response($output ?: 'Migrations completed');
        } catch (Exception $e) {
            Log::error('Migration failed: ' . $e->getMessage());
            return response('Migration failed', 500);
        }
    })->name('legacy.migrations.run');
});
