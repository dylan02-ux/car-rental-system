<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use App\Models\Payment;

class DashboardController extends Controller
{
    //displays admin dashboard with statistics
    public function index()
    {
        $totalCars = Car::count();
        $totalBookings = Booking::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalRevenue = Payment::where('status', 'completed')->sum('amount');
        
        $recentBookings = Booking::with(['user', 'car'])
            ->latest()
            ->take(5)
            ->get();
        
        $pendingBookings = Booking::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalCars',
            'totalBookings',
            'totalCustomers',
            'totalRevenue',
            'recentBookings',
            'pendingBookings'
        ));
    }
}