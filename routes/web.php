<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Dashboard route


// Authentication routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password reset routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    // Profile routes


    // Resource routes
    Route::resource('customers', CustomerController::class);
    Route::resource('leads', LeadController::class);
    Route::resource('interactions', InteractionController::class);

    // Manager and admin routes
    Route::middleware(['role:manager,admin'])->group(function () {
        Route::get('/reports/sales-performance', [ReportController::class, 'salesPerformance'])->name('reports.sales-performance');
        Route::get('/reports/sales-performance/export', [ReportController::class, 'exportSalesPerformance'])->name('reports.sales-performance.export');
    });

    // Admin-only routes
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
        // Add more admin routes as needed
    });
});