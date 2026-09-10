<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Customer\BookingController as CustomerBookingController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| Laravel Breeze handles login, logout, registration, password reset,
| email verification, and other authentication routes.
|
*/

require __DIR__ . '/auth.php';


/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
|
| These routes require the user to be logged in.
|
*/

Route::middleware(['auth'])->group(function () {

    // Home / Vehicle Catalog
    Route::get('/', [HomeController::class, 'index'])
        ->name('home');

    // Vehicle Details
    Route::get('/cars/{car}', [HomeController::class, 'show'])
        ->name('cars.show');

    // Vehicle Search
    Route::get('/search', [HomeController::class, 'search'])
        ->name('cars.search');

    // Rental Checkout
    Route::get('/rent/{car}', [CustomerBookingController::class, 'checkout'])
        ->name('bookings.checkout');

    // Submit Rental Request
    Route::post('/rent/{car}', [CustomerBookingController::class, 'storePublic'])
        ->name('bookings.storePublic');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| All administrator management pages are located under /admin.
|
*/

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Admin Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Cars
        |--------------------------------------------------------------------------
        */

        Route::resource('cars', AdminCarController::class);


        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        Route::resource('categories', AdminCategoryController::class);


        /*
        |--------------------------------------------------------------------------
        | Booking Status Actions
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/bookings/{booking}/approve',
            [AdminBookingController::class, 'approve']
        )->name('bookings.approve');

        Route::post(
            '/bookings/{booking}/reject',
            [AdminBookingController::class, 'reject']
        )->name('bookings.reject');

        Route::post(
            '/bookings/{booking}/complete',
            [AdminBookingController::class, 'complete']
        )->name('bookings.complete');


        /*
        |--------------------------------------------------------------------------
        | Booking Management
        |--------------------------------------------------------------------------
        */

        Route::resource('bookings', AdminBookingController::class);
    });


/*
|--------------------------------------------------------------------------
| Dashboard Redirect
|--------------------------------------------------------------------------
|
| Laravel Breeze may send users to /dashboard after login.
|
| Administrators are redirected to the admin dashboard.
| Normal customers are redirected to the vehicle catalog.
|
*/

Route::middleware(['auth'])
    ->get('/dashboard', function () {

        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');

    })
    ->name('dashboard');