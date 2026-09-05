@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="bg-indigo-600 px-6 py-8 text-white">
            <h1 class="text-2xl font-bold">Complete Your Reservation</h1>
            <p class="text-indigo-100 text-sm mt-1">Provide your details to rent the {{ $car->brand }} {{ $car->model }}</p>
        </div>

        <form action="{{ route('bookings.storePublic', $car) }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-xl border border-slate-200">
                @if($car->image && Storage::disk('public')->exists($car->image))
                    <img src="{{ Storage::url($car->image) }}" class="w-24 h-20 object-cover rounded-lg">
                @endif
                <div>
                    <h3 class="font-bold text-slate-900">{{ $car->brand }} {{ $car->model }}</h3>
                    <p class="text-sm text-slate-500">{{ $car->year }} • {{ ucfirst($car->transmission) }}</p>
                    <p class="text-indigo-600 font-bold mt-1">${{ number_format($car->daily_rate, 2) }} / day</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Full Name</label>
                    <input type="text" name="customer_name" required value="{{ old('customer_name') }}" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('customer_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                    <input type="email" name="customer_email" required value="{{ old('customer_email') }}" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('customer_email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Phone Number</label>
                    <input type="text" name="customer_phone" required value="{{ old('customer_phone') }}" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('customer_phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Address</label>
                    <input type="text" name="customer_address" required value="{{ old('customer_address') }}" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('customer_address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Start Date</label>
                    <input type="date" name="start_date" required value="{{ old('start_date', date('Y-m-d')) }}" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('start_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">End Date</label>
                    <input type="date" name="end_date" required value="{{ old('end_date', date('Y-m-d', strtotime('+1 day'))) }}" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('end_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition-colors shadow-md">
                Confirm Reservation
            </button>
        </form>
    </div>
</div>
@endsection
