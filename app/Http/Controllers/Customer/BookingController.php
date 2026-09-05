<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    // show booking form for a specific car (public, no login required)
    public function create(Car $car)
    {
        if ($car->status !== 'available') {
            return redirect()->back()->with('error', 'This car is not available');
        }

        return view('customer.bookings.create', compact('car'));
    }

    // store new booking request from a guest
    public function store(Request $request, Car $car)
    {
        $validated = $request->validate([
            'guest_name' => 'required|string|max:255',
            'guest_phone' => 'required|string|max:50',
            'guest_email' => 'required|email|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'payment_method' => 'required|in:credit_card,cash,bank_transfer',
        ]);

        // checks if car has already been booked for the given dates
        $hasConflict = Booking::where('car_id', $car->id)
            ->whereIn('status', ['pending', 'approved'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_date', [$validated['start_date'], $validated['end_date']])
                    ->orWhereBetween('end_date', [$validated['start_date'], $validated['end_date']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('start_date', '<=', $validated['start_date'])
                          ->where('end_date', '>=', $validated['end_date']);
                    });
            })
            ->exists();

        if ($hasConflict) {
            return redirect()->back()
                ->with('error', 'Car is not available for selected dates')
                ->withInput();
        }

        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $totalDays = $startDate->diffInDays($endDate);
        $totalPrice = $totalDays * $car->daily_rate;

        $booking = Booking::create([
            'user_id' => null,
            'car_id' => $car->id,
            'guest_name' => $validated['guest_name'],
            'guest_phone' => $validated['guest_phone'],
            'guest_email' => $validated['guest_email'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_days' => $totalDays,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $totalPrice,
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
        ]);

        return redirect()->route('home')
            ->with('success', 'Booking request submitted! Our team will contact you shortly to confirm.');
    }
}