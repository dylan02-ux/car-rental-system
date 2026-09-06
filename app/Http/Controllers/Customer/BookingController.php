<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function checkout(Car $car)
    {
        return view('customer.bookings.create', compact('car'));
    }

    public function storePublic(Request $request, Car $car)
    {
        $validated = $request->validate([
            'guest_name'     => 'required|string|max:255',
            'guest_email'    => 'required|email|max:255',
            'guest_phone'    => 'required|string|max:50',
            'start_date'     => 'required|date|after_or_equal:today',
            'end_date'       => 'required|date|after:start_date',
            'payment_method' => 'required|string',
        ]);

        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $totalDays = max(1, $startDate->diffInDays($endDate));
        
        $dailyRate = $car->price_per_day ?? $car->daily_rate ?? 0;
        $totalPrice = $totalDays * $dailyRate;

        $booking = Booking::create([
            'user_id'     => auth()->id(),
            'car_id'      => $car->id,
            'guest_name'  => $validated['guest_name'],
            'guest_phone' => $validated['guest_phone'],
            'guest_email' => $validated['guest_email'],
            'start_date'  => $validated['start_date'],
            'end_date'    => $validated['end_date'],
            'total_days'  => $totalDays,
            'total_price' => $totalPrice,
            'status'      => 'pending',
        ]);

        Payment::create([
            'booking_id'     => $booking->id,
            'amount'         => $totalPrice,
            'payment_method' => $validated['payment_method'],
            'status'         => 'pending',
        ]);

        return redirect()->route('home')
            ->with('success', 'Booking request submitted! Our team will contact you shortly to confirm.');
    }
}