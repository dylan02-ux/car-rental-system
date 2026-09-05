<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['car', 'user'])->latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create(Request $request)
    {
        $selectedCarId = $request->query('car_id');
        $cars = Car::where('status', 'available')->get();

        return view('admin.bookings.create', compact('cars', 'selectedCarId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:50',
            'customer_address' => 'required|string|max:500',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $car = Car::findOrFail($validated['car_id']);

        $startDate = \Carbon\Carbon::parse($validated['start_date']);
        $endDate = \Carbon\Carbon::parse($validated['end_date']);
        $days = $startDate->diffInDays($endDate) ?: 1;
        $totalPrice = $days * $car->daily_rate;

        Booking::create([
            'car_id' => $car->id,
            'user_id' => auth()->id(),
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'customer_address' => $validated['customer_address'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_days' => $days,
            'total_price' => $totalPrice,
            'status' => 'approved',
        ]);

        $car->update(['status' => 'rented']);

        return redirect()->route('admin.bookings.index')->with('success', 'Rental successfully assigned!');
    }

    public function show(Booking $booking)
    {
        $booking->load(['car', 'user']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function approve(Booking $booking)
    {
        $booking->update(['status' => 'approved']);
        $booking->car->update(['status' => 'rented']);

        return redirect()->back()->with('success', 'Booking approved successfully.');
    }

    public function reject(Booking $booking)
    {
        $booking->update(['status' => 'rejected']);
        $booking->car->update(['status' => 'available']);

        return redirect()->back()->with('success', 'Booking rejected successfully.');
    }

    public function complete(Booking $booking)
    {
        $booking->update(['status' => 'completed']);
        $booking->car->update(['status' => 'available']);

        return redirect()->back()->with('success', 'Booking marked as completed.');
    }
}