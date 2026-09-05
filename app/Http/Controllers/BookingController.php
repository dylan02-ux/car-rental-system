<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function checkout(Car $car)
    {
        return view('bookings.checkout', compact('car'));
    }

    public function storePublic(Request $request, Car $car)
    {
        $validated = $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_email'   => 'required|email|max:255',
            'customer_phone'   => 'required|string|max:50',
            'customer_address' => 'required|string|max:500',
            'start_date'       => 'required|date|after_or_equal:today',
            'end_date'         => 'required|date|after:start_date',
        ]);

        $startDate = \Carbon\Carbon::parse($validated['start_date']);
        $endDate   = \Carbon\Carbon::parse($validated['end_date']);
        $days      = $startDate->diffInDays($endDate) ?: 1;
        $totalPrice = $days * $car->daily_rate;

        Booking::create([
            'car_id'           => $car->id,
            'user_id'          => auth()->check() ? auth()->id() : null,
            'customer_name'    => $validated['customer_name'],
            'customer_email'   => $validated['customer_email'],
            'customer_phone'   => $validated['customer_phone'],
            'customer_address' => $validated['customer_address'],
            'start_date'       => $validated['start_date'],
            'end_date'         => $validated['end_date'],
            'total_days'       => $days,
            'total_price'      => $totalPrice,
            'status'           => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'Your reservation request has been submitted!');
    }
}
