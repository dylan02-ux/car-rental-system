<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //create new review
    public function create(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->status !== 'completed') {
            return redirect()->back()
                ->with('error', 'You can only review completed bookings');
        }

        if ($booking->review) {
            return redirect()->back()
                ->with('error', 'You have already reviewed this booking');
        }

        return view('customer.reviews.create', compact('booking'));
    }

    //store review in db
    public function store(Request $request, Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->review) {
            return redirect()->back()
                ->with('error', 'You have already reviewed this booking');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'car_id' => $booking->car_id,
            'booking_id' => $booking->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->route('customer.bookings.show', $booking)
            ->with('success', 'Review submitted successfully');
    }
}