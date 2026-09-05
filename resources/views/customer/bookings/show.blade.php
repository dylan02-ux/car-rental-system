@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Booking Details #{{ $booking->id }}</h1>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold mb-4">Car Information</h3>
                <p class="text-gray-600"><strong>Car:</strong> {{ $booking->car->brand }} {{ $booking->car->model }}</p>
                <p class="text-gray-600"><strong>Year:</strong> {{ $booking->car->year }}</p>
                <p class="text-gray-600"><strong>Color:</strong> {{ $booking->car->color }}</p>
                <p class="text-gray-600"><strong>Seats:</strong> {{ $booking->car->seats }}</p>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Booking Information</h3>
                <p class="text-gray-600"><strong>Start Date:</strong> {{ $booking->start_date->format('M d, Y') }}</p>
                <p class="text-gray-600"><strong>End Date:</strong> {{ $booking->end_date->format('M d, Y') }}</p>
                <p class="text-gray-600"><strong>Total Days:</strong> {{ $booking->total_days }}</p>
                <p class="text-gray-600"><strong>Total Price:</strong> ${{ number_format($booking->total_price, 2) }}</p>
            </div>
        </div>

        <div class="mt-6">
            <h3 class="text-lg font-semibold mb-2">Status</h3>
            <span class="px-4 py-2 text-sm font-semibold rounded-full 
                @if($booking->status === 'pending') bg-yellow-100 text-yellow-800
                @elseif($booking->status === 'approved') bg-green-100 text-green-800
                @elseif($booking->status === 'rejected') bg-red-100 text-red-800
                @elseif($booking->status === 'completed') bg-blue-100 text-blue-800
                @else bg-gray-100 text-gray-800
                @endif">
                {{ ucfirst($booking->status) }}
            </span>

            @if($booking->status === 'pending')
                <p class="text-gray-600 mt-2">Your booking is pending admin approval.</p>
            @elseif($booking->status === 'approved')
                <p class="text-gray-600 mt-2">Your booking has been approved! Enjoy your ride.</p>
            @elseif($booking->status === 'rejected')
                <p class="text-gray-600 mt-2">Unfortunately, your booking was rejected.</p>
            @elseif($booking->status === 'completed')
                <p class="text-gray-600 mt-2">Your booking is completed. Thank you!</p>
            @endif
        </div>

        @if($booking->payment)
            <div class="mt-6">
                <h3 class="text-lg font-semibold mb-2">Payment Information</h3>
                <p class="text-gray-600"><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $booking->payment->payment_method)) }}</p>
                <p class="text-gray-600"><strong>Payment Status:</strong> 
                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                        @if($booking->payment->status === 'completed') bg-green-100 text-green-800
                        @elseif($booking->payment->status === 'pending') bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($booking->payment->status) }}
                    </span>
                </p>
            </div>
        @endif
    </div>

    <div class="flex space-x-3">
        <a href="{{ route('customer.bookings.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Back to My Bookings</a>
        
        @if(in_array($booking->status, ['pending', 'approved']))
            <form action="{{ route('customer.bookings.cancel', $booking) }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel Booking</button>
            </form>
        @endif

        @if($booking->status === 'completed' && !$booking->review)
            <a href="{{ route('customer.reviews.create', $booking) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Leave Review</a>
        @endif
    </div>
</div>
@endsection