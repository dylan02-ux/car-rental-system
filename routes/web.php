<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Customer\BookingController as CustomerBookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;

// Include Laravel Breeze Authentication Routes (login, logout, registration)
require __DIR__.'/auth.php';

// Public Catalog & Rental Flow (Requires Login)
Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/cars/{car}', [HomeController::class, 'show'])->name('cars.show');
    Route::get('/search', [HomeController::class, 'search'])->name('cars.search');

    Route::get('/rent/{car}', [CustomerBookingController::class, 'checkout'])->name('bookings.checkout');
    Route::post('/rent/{car}', [CustomerBookingController::class, 'storePublic'])->name('bookings.storePublic');
});

// Central Admin Management Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('cars', AdminCarController::class);
    Route::resource('categories', AdminCategoryController::class);
    
    // Custom Booking Action Routes
    Route::post('bookings/{booking}/approve', [AdminBookingController::class, 'approve'])->name('bookings.approve');
    Route::post('bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('bookings.reject');
    Route::post('bookings/{booking}/complete', [AdminBookingController::class, 'complete'])->name('bookings.complete');
    
    Route::resource('bookings', AdminBookingController::class);
});

// Root Dashboard Alias Redirect
Route::middleware(['auth'])->get('/dashboard', function () {
    if (auth()->user()->role !== 'admin') {
        return redirect()->route('home');
    }
    return redirect()->route('admin.dashboard');
})->name('dashboard');