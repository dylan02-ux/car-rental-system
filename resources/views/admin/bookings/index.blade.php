@extends('layouts.app')

@section('content')

<style>
    body {
        background:
            radial-gradient(
                circle at 12% 18%,
                rgba(79, 70, 229, 0.10),
                transparent 30%
            ),
            radial-gradient(
                circle at 88% 42%,
                rgba(59, 130, 246, 0.08),
                transparent 30%
            ),
            linear-gradient(
                135deg,
                #e7edf4 0%,
                #f4f7fa 48%,
                #dce6ef 100%
            );

        background-attachment: fixed;
    }
</style>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Success Message -->
    @if(session('success'))

        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm font-medium shadow-sm">

            {{ session('success') }}

        </div>

    @endif


    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">

        <div>

            <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-500 mb-2">
                Rental Management
            </p>

            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900">
                Manage Bookings
            </h1>

            <p class="text-slate-500 mt-2">
                Review rental requests, monitor booking status, and manage active rentals.
            </p>

        </div>


        <a
            href="{{ route('admin.bookings.create') }}"
            class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-3 rounded-xl shadow-sm transition"
        >
            <span class="text-lg">
                +
            </span>

            Assign New Rental
        </a>

    </div>


    <!-- Bookings Table -->
    <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-sm border border-white/80 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-left border-collapse">

                <thead>

                    <tr class="bg-slate-50/80 text-slate-500 text-xs uppercase tracking-wider">

                        <th class="px-6 py-4 font-semibold">
                            ID
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Customer
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Car
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Dates
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Total
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Status
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">

                    @forelse($bookings as $booking)

                        <tr class="hover:bg-slate-50/80 transition-colors">

                            <!-- ID -->
                            <td class="px-6 py-4 font-bold text-slate-900 whitespace-nowrap">
                                #{{ $booking->id }}
                            </td>


                            <!-- Customer -->
                            <td class="px-6 py-4">

                                <div class="font-semibold text-slate-900">
                                    {{ $booking->customer_name ?? $booking->user->name ?? 'Guest' }}
                                </div>

                                @if($booking->customer_phone)

                                    <div class="text-xs text-slate-400 mt-1">
                                        {{ $booking->customer_phone }}
                                    </div>

                                @endif

                            </td>


                            <!-- Car -->
                            <td class="px-6 py-4 whitespace-nowrap">

                                <div class="font-semibold text-slate-800">
                                    {{ $booking->car->brand ?? '' }}
                                    {{ $booking->car->model ?? '' }}
                                </div>

                                @if($booking->car)

                                    <div class="text-xs text-slate-400 mt-1">
                                        {{ $booking->car->year ?? '' }}
                                    </div>

                                @endif

                            </td>


                            <!-- Dates -->
                            <td class="px-6 py-4 whitespace-nowrap">

                                <div class="font-medium text-slate-800">

                                    {{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }}

                                    <span class="text-slate-400 mx-1">
                                        →
                                    </span>

                                    {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}

                                </div>

                                <div class="text-xs text-slate-400 mt-1">
                                    {{ $booking->total_days }} days
                                </div>

                            </td>


                            <!-- Total -->
                            <td class="px-6 py-4 whitespace-nowrap">

                                <span class="font-extrabold text-slate-900">
                                    ${{ number_format($booking->total_price, 2) }}
                                </span>

                            </td>


                            <!-- Status -->
                            <td class="px-6 py-4 whitespace-nowrap">

                                @if($booking->status === 'pending')

                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-100">

                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>

                                        Pending

                                    </span>

                                @elseif($booking->status === 'approved')

                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">

                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>

                                        Approved

                                    </span>

                                @elseif($booking->status === 'completed')

                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">

                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                        Completed

                                    </span>

                                @elseif($booking->status === 'rejected')

                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-100">

                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>

                                        Rejected

                                    </span>

                                @else

                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">

                                        {{ ucfirst($booking->status) }}

                                    </span>

                                @endif

                            </td>


                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap">

                                <a
                                    href="{{ route('admin.bookings.show', $booking->id) }}"
                                    class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-100 font-semibold transition"
                                >
                                    View
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="px-6 py-12 text-center text-slate-400 font-medium"
                            >
                                No bookings found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    <!-- Pagination -->
    <div class="mt-6">
        {{ $bookings->links() }}
    </div>

</div>

@endsection