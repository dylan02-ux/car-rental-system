@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-500 text-sm">Total Cars</p>
            <p class="text-3xl font-bold text-gray-900">{{ $totalCars }}</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-500 text-sm">Total Bookings</p>
            <p class="text-3xl font-bold text-gray-900">{{ $totalBookings }}</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-500 text-sm">Total Customers</p>
            <p class="text-3xl font-bold text-gray-900">{{ $totalCustomers }}</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-500 text-sm">Total Revenue</p>
            <p class="text-3xl font-bold text-gray-900">${{ number_format($totalRevenue, 2) }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <a href="{{ route('admin.cars.index') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <h3 class="text-xl font-bold mb-2">Manage Cars</h3>
            <p class="text-gray-600">Add, edit, or remove cars from inventory</p>
        </a>

        <a href="{{ route('admin.categories.index') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <h3 class="text-xl font-bold mb-2">Manage Categories</h3>
            <p class="text-gray-600">Organize cars into categories</p>
        </a>

        <a href="{{ route('admin.bookings.index') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <h3 class="text-xl font-bold mb-2">Manage Bookings</h3>
            <p class="text-gray-600">View and manage customer bookings</p>
            @if($pendingBookings > 0)
                <span class="inline-block bg-red-500 text-white text-xs px-2 py-1 rounded-full mt-2">{{ $pendingBookings }} Pending</span>
            @endif
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-4">Recent Bookings</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Car</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dates</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recentBookings as $booking)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $booking->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $booking->car->brand }} {{ $booking->car->model }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $booking->start_date->format('M d') }} - {{ $booking->end_date->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($booking->status === 'approved') bg-green-100 text-green-800
                                    @elseif($booking->status === 'rejected') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">${{ number_format($booking->total_price, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No bookings yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection