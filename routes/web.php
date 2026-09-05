<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;

// Authentication Routes (Laravel Breeze)
require __DIR__.'/auth.php';

// Protected Catalog & Rental Flow (Requires Login)
Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/cars/{car}', [HomeController::class, 'show'])->name('cars.show');
    Route::get('/search', [HomeController::class, 'search'])->name('cars.search');

    Route::get('/rent/{car}', [BookingController::class, 'checkout'])->name('bookings.checkout');
    Route::post('/rent/{car}', [BookingController::class, 'storePublic'])->name('bookings.storePublic');

    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');
});

// Admin & Staff Internal Management Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('cars', AdminCarController::class);
    Route::resource('categories', AdminCategoryController::class);

    // Internal Booking Management
    Route::prefix('bookings')->name('bookings.')->group(function () {
        Route::get('/', [AdminBookingController::class, 'index'])->name('index');
        Route::get('/create', [AdminBookingController::class, 'create'])->name('create');
        Route::post('/', [AdminBookingController::class, 'store'])->name('store');
        Route::get('/{booking}', [AdminBookingController::class, 'show'])->name('show');
        Route::post('/{booking}/approve', [AdminBookingController::class, 'approve'])->name('approve');
        Route::post('/{booking}/reject', [AdminBookingController::class, 'reject'])->name('reject');
        Route::post('/{booking}/complete', [AdminBookingController::class, 'complete'])->name('complete');
    });
});