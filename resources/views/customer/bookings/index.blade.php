@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">My Bookings</h1>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        @forelse($bookings as $booking)
            <div class="border-b p-6 hover:bg-gray-50">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-900">{{ $booking->car->brand }} {{ $booking->car->model }}</h3>
                        <p class="text-gray-600 mt-2">
                            <strong>Dates:</strong> {{ $booking->start_date->format('M d, Y') }} - {{ $booking->end_date->format('M d, Y') }}
                        </p>
                        <p class="text-gray-600">
                            <strong>Duration:</strong> {{ $booking->total_days }} days
                        </p>
                        <p class="text-gray-600">
                            <strong>Total Price:</strong> ${{ number_format($booking->total_price, 2) }}
                        </p>
                        <p class="mt-2">
                            <span class="px-3 py-1 text-sm font-semibold rounded-full 
                                @if($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($booking->status === 'approved') bg-green-100 text-green-800
                                @elseif($booking->status === 'rejected') bg-red-100 text-red-800
                                @elseif($booking->status === 'completed') bg-blue-100 text-blue-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </p>
                    </div>

                    <div class="ml-4 flex flex-col space-y-2">
                        <a href="{{ route('customer.bookings.show', $booking) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">View Details</a>
                        
                        @if(in_array($booking->status, ['pending', 'approved']))
                            <form action="{{ route('customer.bookings.cancel', $booking) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel</button>
                            </form>
                        @endif

                        @if($booking->status === 'completed' && !$booking->review)
                            <a href="{{ route('customer.reviews.create', $booking) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded text-center">Leave Review</a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="p-6 text-center text-gray-500">
                <p class="text-xl">You have no bookings yet.</p>
                <a href="{{ route('home') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Browse Cars</a>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $bookings->links() }}
    </div>
</div>
@endsection