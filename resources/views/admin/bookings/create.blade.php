@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Assign New Rental</h1>
            <p class="text-slate-500 text-sm">Manually create a booking record for a phone or walk-in customer.</p>
        </div>
        <a href="{{ route('admin.bookings.index') }}" class="text-slate-600 hover:text-indigo-600 font-medium text-sm">
            ← Back to Bookings
        </a>
    </div>

    <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm">
        <form action="{{ route('admin.bookings.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Customer Details -->
            <div>
                <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Customer Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Full Name</label>
                        <input type="text" name="customer_name" required class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500" placeholder="e.g. John Doe">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Email Address</label>
                        <input type="email" name="email" required class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500" placeholder="e.g. john@example.com">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Phone Number</label>
                        <input type="text" name="phone" required class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500" placeholder="e.g. +1 555 0192">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Physical Address</label>
                        <input type="text" name="address" class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500" placeholder="e.g. 123 Main St">
                    </div>
                </div>
            </div>

            <hr class="border-slate-100">

            <!-- Vehicle & Rental Selection -->
            <div>
                <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Vehicle & Schedule</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Select Vehicle</label>
                        <select name="car_id" required class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 bg-white">
                            <option value="">-- Select a Car --</option>
                            @foreach($cars as $car)
                                <option value="{{ $car->id }}">{{ $car->brand }} {{ $car->model }} (${{ number_format($car->price_per_day, 2) }}/day)</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Start Date</label>
                        <input type="date" name="start_date" required class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">End Date</label>
                        <input type="date" name="end_date" required class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500">
                    </div>
                </div>
            </div>

            <div class="pt-4 flex justify-end gap-3">
                <a href="{{ route('admin.bookings.index') }}" class="px-4 py-2 border border-slate-200 rounded-xl text-slate-600 text-sm font-semibold hover:bg-slate-50 transition-colors">Cancel</a>
                <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-semibold transition-colors shadow-sm">Save Booking</button>
            </div>
        </form>
    </div>
</div>
@endsection
