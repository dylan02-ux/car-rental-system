@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Leave a Review</h1>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h3 class="text-xl font-semibold mb-2">{{ $booking->car->brand }} {{ $booking->car->model }}</h3>
        <p class="text-gray-600">Rented from {{ $booking->start_date->format('M d, Y') }} to {{ $booking->end_date->format('M d, Y') }}</p>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('customer.reviews.store', $booking) }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                <select name="rating" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="">Select Rating</option>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Good</option>
                    <option value="3">3 - Average</option>
                    <option value="2">2 - Poor</option>
                    <option value="1">1 - Very Poor</option>
                </select>
                @error('rating')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Comment (Optional)</label>
                <textarea name="comment" rows="5" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Share your experience...">{{ old('comment') }}</textarea>
                @error('comment')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-3">
                <a href="{{ route('customer.bookings.show', $booking) }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded text-center">Cancel</a>
                <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit Review</button>
            </div>
        </form>
    </div>
</div>
@endsection