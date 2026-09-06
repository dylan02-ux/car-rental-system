@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $car->name }}</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    @if($car->image)
                        <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}" class="w-full h-64 object-cover rounded-lg">
                    @else
                        <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-400 rounded-lg">No Image</div>
                    @endif
                </div>
                <div>
                    <p class="text-gray-600 mb-2"><strong>Category:</strong> {{ $car->category->name ?? 'N/A' }}</p>
                    <p class="text-gray-600 mb-2"><strong>Year:</strong> {{ $car->year }}</p>
                    <p class="text-gray-600 mb-2"><strong>Color:</strong> {{ $car->color }}</p>
                    <p class="text-gray-600 mb-2"><strong>Price per Day:</strong> ${{ number_format($car->price_per_day, 2) }}</p>
                    <p class="text-gray-600 mb-2"><strong>Transmission:</strong> {{ $car->transmission ?? 'Automatic' }}</p>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2">Description</h3>
                <p class="text-gray-600">{{ $car->description ?? 'No description available.' }}</p>
            </div>

            <div class="flex space-x-4">
                <a href="{{ route('home') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Back
                </a>
                <a href="{{ route('bookings.checkout', $car->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Rent This Vehicle
                </a>
            </div>
        </div>
    </div>
</div>
@endsection