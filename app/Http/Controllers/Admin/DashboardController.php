<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Booking;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $carCount = Car::count();
        $bookingCount = Booking::count();
        $categoryCount = Category::count();
        $recentBookings = Booking::with(['car', 'user'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('carCount', 'bookingCount', 'categoryCount', 'recentBookings'));
    }
}
