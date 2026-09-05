cat << 'EOF' > resources/views/admin/bookings/show.blade.php
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Booking Details #{{ $booking->id }}</h1>
            <p class="text-xs text-slate-400 mt-1">Processed by staff: {{ $booking->user->name ?? 'Admin' }}</p>
        </div>
        <a href="{{ route('admin.bookings.index') }}" class="text-slate-600 hover:text-slate-900 text-sm font-medium">&larr; Back to Bookings</a>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- Customer & Vehicle Details --}}
        <div class="md:col-span-2 space-y-6">
            
            {{-- Customer Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                <h2 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Customer Information</h2>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-slate-400 block text-xs">Full Name</span>
                        <span class="font-semibold text-slate-800">{{ $booking->customer_name ?? $booking->user->name }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-xs">Email Address</span>
                        <span class="font-semibold text-slate-800">{{ $booking->customer_email ?? $booking->user->email }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-xs">Phone Number</span>
                        <span class="font-semibold text-slate-800">{{ $booking->customer_phone ?? 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-xs">Physical Address</span>
                        <span class="font-semibold text-slate-800">{{ $booking->customer_address ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            {{-- Vehicle Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                <h2 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Rented Vehicle</h2>
                <div class="flex items-center gap-4">
                    @if($booking->car->image && Storage::disk('public')->exists($booking->car->image))
                        <img src="{{ Storage::url($booking->car->image) }}" alt="{{ $booking->car->brand }}" class="w-20 h-20 object-cover rounded-lg border border-slate-100">
                    @else
                        <div class="w-20 h-20 bg-slate-100 rounded-lg flex items-center justify-center text-xs text-slate-400">No Image</div>
                    @endif
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">{{ $booking->car->brand }} {{ $booking->car->model }}</h3>
                        <p class="text-xs text-slate-500">{{ $booking->car->year }} &bull; {{ ucfirst($booking->car->transmission) }} &bull; {{ $booking->car->color }}</p>
                        <p class="text-sm font-bold text-indigo-600 mt-1">${{ number_format($booking->car->daily_rate, 2) }} / day</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Summary & Status Actions --}}
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                <h2 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Rental Summary</h2>
                
                <div class="space-y-3 text-sm pb-4 border-b border-slate-100">
                    <div class="flex justify-between">
                        <span class="text-slate-500">Start Date</span>
                        <span class="font-medium text-slate-800">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">End Date</span>
                        <span class="font-medium text-slate-800">{{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Duration</span>
                        <span class="font-medium text-slate-800">{{ $booking->total_days }} Days</span>
                    </div>
                </div>

                <div class="flex justify-between items-center py-4 border-b border-slate-100 mb-6">
                    <span class="font-bold text-slate-900">Total Charged</span>
                    <span class="text-xl font-extrabold text-indigo-600">${{ number_format($booking->total_price, 2) }}</span>
                </div>

                {{-- Status Management Buttons --}}
                <div class="space-y-2">
                    <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Update Status</span>
                    
                    @if($booking->status !== 'approved')
                        <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-4 rounded-lg text-xs shadow-sm transition-colors">
                                Approve Rental
                            </button>
                        </form>
                    @endif

                    @if($booking->status !== 'completed')
                        <form action="{{ route('admin.bookings.complete', $booking->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg text-xs shadow-sm transition-colors">
                                Mark as Completed (Car Returned)
                            </button>
                        </form>
                    @endif

                    @if($booking->status !== 'rejected')
                        <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 font-semibold py-2 px-4 rounded-lg text-xs transition-colors">
                                Reject Rental
                            </button>
                        </form>
                    @endif
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
EOF