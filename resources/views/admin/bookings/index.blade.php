@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    @if(session('success'))
        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Manage Bookings</h1>
        <a href="{{ route('admin.bookings.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg text-sm shadow-sm transition-colors">
            + Assign New Rental
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-xs font-bold text-slate-500 uppercase tracking-wider">
                    <th class="py-3 px-4">ID</th>
                    <th class="py-3 px-4">Customer</th>
                    <th class="py-3 px-4">Car</th>
                    <th class="py-3 px-4">Dates</th>
                    <th class="py-3 px-4">Total</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($bookings as $booking)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-3.5 px-4 font-semibold text-slate-700">#{{ $booking->id }}</td>
                        <td class="py-3.5 px-4">
                            <div class="font-semibold text-slate-900">{{ $booking->customer_name ?? $booking->user->name }}</div>
                            @if($booking->customer_phone)
                                <div class="text-xs text-slate-400">{{ $booking->customer_phone }}</div>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-slate-800 font-medium">
                            {{ $booking->car->brand }} {{ $booking->car->model }}
                        </td>
                        <td class="py-3.5 px-4">
                            <div class="text-slate-800 font-medium">
                                {{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}
                            </div>
                            <div class="text-xs text-slate-400">{{ $booking->total_days }} days</div>
                        </td>
                        <td class="py-3.5 px-4 font-bold text-slate-900">${{ number_format($booking->total_price, 2) }}</td>
                        <td class="py-3.5 px-4">
                            @if($booking->status === 'approved')
                                <span class="bg-emerald-50 text-emerald-700 text-xs px-2.5 py-1 rounded-full font-semibold">Approved</span>
                            @elseif($booking->status === 'completed')
                                <span class="bg-blue-50 text-blue-700 text-xs px-2.5 py-1 rounded-full font-semibold">Completed</span>
                            @elseif($booking->status === 'rejected')
                                <span class="bg-red-50 text-red-700 text-xs px-2.5 py-1 rounded-full font-semibold">Rejected</span>
                            @else
                                <span class="bg-amber-50 text-amber-700 text-xs px-2.5 py-1 rounded-full font-semibold">{{ ucfirst($booking->status) }}</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4">
                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium text-xs">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-slate-400">No bookings found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $bookings->links() }}
    </div>
</div>
@endsection
