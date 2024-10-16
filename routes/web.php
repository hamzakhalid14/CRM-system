<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\ReportController;

Route::middleware(['auth'])->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('leads', LeadController::class);
    Route::resource('interactions', InteractionController::class);

    Route::middleware(['role:manager,admin'])->group(function () {
        Route::get('/reports/sales-performance', [ReportController::class, 'salesPerformance'])->name('reports.sales-performance');
        Route::get('/reports/sales-performance/export', [ReportController::class, 'exportSalesPerformance'])->name('reports.sales-performance.export');
    });
});