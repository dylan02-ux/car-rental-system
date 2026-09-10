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


<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <!-- Back Link -->
    <div class="mb-6">
        <a
            href="{{ route('home') }}"
            class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-indigo-600 transition"
        >
            <span>←</span>
            Back to Fleet
        </a>
    </div>


    <!-- Page Header -->
    <div class="mb-8">

        <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-500 mb-2">
            Reservation Details
        </p>

        <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900">
            Booking #{{ $booking->id }}
        </h1>

        <p class="text-slate-500 mt-2">
            Review your vehicle, rental period, total price, and reservation status.
        </p>

    </div>


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

        <!-- Left Side -->
        <div class="lg:col-span-2 space-y-6">


            <!-- Vehicle Information -->
            <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-sm border border-white/80 overflow-hidden">

                <div class="px-7 py-6 border-b border-slate-100">

                    <h2 class="text-sm font-bold text-slate-400 uppercase tracking-wider">
                        Vehicle Information
                    </h2>

                </div>


                <div class="p-7">

                    <div class="flex flex-col sm:flex-row gap-6">

                        <!-- Vehicle Image -->
                        <div class="sm:w-48 flex-shrink-0">

                            @if(
                                $booking->car->image &&
                                Storage::disk('public')->exists($booking->car->image)
                            )

                                <img
                                    src="{{ Storage::url($booking->car->image) }}"
                                    alt="{{ $booking->car->brand }} {{ $booking->car->model ?? $booking->car->name }}"
                                    class="w-full h-36 object-cover rounded-2xl border border-slate-100"
                                >

                            @else

                                <div class="w-full h-36 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-400 text-sm">
                                    No Image Available
                                </div>

                            @endif

                        </div>


                        <!-- Vehicle Details -->
                        <div class="flex-1">

                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">

                                <div>

                                    <h3 class="text-2xl font-extrabold text-slate-900">
                                        {{ $booking->car->brand ?? '' }}
                                        {{ $booking->car->model ?? $booking->car->name }}
                                    </h3>

                                    <p class="text-sm text-slate-400 mt-1">
                                        {{ $booking->car->category->name ?? 'Vehicle' }}
                                    </p>

                                </div>


                                <span class="self-start bg-indigo-50 text-indigo-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                    {{ $booking->car->year }}
                                </span>

                            </div>


                            <div class="grid grid-cols-2 gap-4 mt-6">

                                <div class="bg-slate-50 rounded-xl p-4">

                                    <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">
                                        Color
                                    </p>

                                    <p class="font-bold text-slate-800">
                                        {{ ucfirst($booking->car->color ?? 'Standard') }}
                                    </p>

                                </div>


                                <div class="bg-slate-50 rounded-xl p-4">

                                    <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">
                                        Seats
                                    </p>

                                    <p class="font-bold text-slate-800">
                                        {{ $booking->car->seats ?? 5 }}
                                    </p>

                                </div>


                                <div class="bg-slate-50 rounded-xl p-4">

                                    <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">
                                        Transmission
                                    </p>

                                    <p class="font-bold text-slate-800">
                                        {{ ucfirst($booking->car->transmission ?? 'Automatic') }}
                                    </p>

                                </div>


                                <div class="bg-slate-50 rounded-xl p-4">

                                    <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">
                                        Daily Rate
                                    </p>

                                    <p class="font-bold text-indigo-600">
                                        ${{ number_format($booking->car->daily_rate ?? 0, 2) }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Booking Information -->
            <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-sm border border-white/80 overflow-hidden">

                <div class="px-7 py-6 border-b border-slate-100">

                    <h2 class="text-sm font-bold text-slate-400 uppercase tracking-wider">
                        Booking Information
                    </h2>

                </div>


                <div class="p-7">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                        <div class="bg-slate-50 rounded-xl p-4">

                            <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">
                                Start Date
                            </p>

                            <p class="font-bold text-slate-800">
                                {{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}
                            </p>

                        </div>


                        <div class="bg-slate-50 rounded-xl p-4">

                            <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">
                                End Date
                            </p>

                            <p class="font-bold text-slate-800">
                                {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}
                            </p>

                        </div>


                        <div class="bg-slate-50 rounded-xl p-4">

                            <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">
                                Total Days
                            </p>

                            <p class="font-bold text-slate-800">
                                {{ $booking->total_days }} Days
                            </p>

                        </div>


                        <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-4">

                            <p class="text-xs text-indigo-400 font-semibold uppercase tracking-wide mb-1">
                                Total Price
                            </p>

                            <p class="text-xl font-extrabold text-indigo-600">
                                ${{ number_format($booking->total_price, 2) }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Payment Information -->
            @if($booking->payment)

                <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-sm border border-white/80 overflow-hidden">

                    <div class="px-7 py-6 border-b border-slate-100">

                        <h2 class="text-sm font-bold text-slate-400 uppercase tracking-wider">
                            Payment Information
                        </h2>

                    </div>


                    <div class="p-7">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                            <div class="bg-slate-50 rounded-xl p-4">

                                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">
                                    Payment Method
                                </p>

                                <p class="font-bold text-slate-800">
                                    {{ ucfirst(str_replace('_', ' ', $booking->payment->payment_method)) }}
                                </p>

                            </div>


                            <div class="bg-slate-50 rounded-xl p-4">

                                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-2">
                                    Payment Status
                                </p>

                                @if($booking->payment->status === 'completed')

                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold">

                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                        Completed

                                    </span>

                                @elseif($booking->payment->status === 'pending')

                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-bold">

                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>

                                        Pending

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-red-700 text-xs font-bold">

                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>

                                        {{ ucfirst($booking->payment->status) }}

                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            @endif

        </div>


        <!-- Right Side -->
        <div>

            <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-sm border border-white/80 overflow-hidden lg:sticky lg:top-24">

                <div class="px-6 py-5 border-b border-slate-100">

                    <p class="text-xs font-bold uppercase tracking-[0.15em] text-indigo-500 mb-1">
                        Reservation Status
                    </p>

                    <h2 class="text-lg font-extrabold text-slate-900">
                        Current Booking
                    </h2>

                </div>


                <div class="p-6">

                    <!-- Status -->
                    <div class="pb-5 border-b border-slate-100">

                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-3">
                            Current Status
                        </p>


                        @if($booking->status === 'pending')

                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-50 text-amber-700 border border-amber-100 text-sm font-bold">

                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>

                                Pending Review

                            </span>

                        @elseif($booking->status === 'approved')

                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-700 border border-blue-100 text-sm font-bold">

                                <span class="w-2 h-2 rounded-full bg-blue-500"></span>

                                Approved

                            </span>

                        @elseif($booking->status === 'completed')

                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100 text-sm font-bold">

                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                                Completed

                            </span>

                        @elseif($booking->status === 'rejected')

                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-50 text-red-700 border border-red-100 text-sm font-bold">

                                <span class="w-2 h-2 rounded-full bg-red-500"></span>

                                Rejected

                            </span>

                        @else

                            <span class="inline-flex px-4 py-2 rounded-full bg-slate-100 text-slate-700 text-sm font-bold">
                                {{ ucfirst($booking->status) }}
                            </span>

                        @endif

                    </div>


                    <!-- Status Message -->
                    <div class="py-5 border-b border-slate-100">

                        @if($booking->status === 'pending')

                            <p class="text-sm text-slate-500 leading-relaxed">
                                Your reservation request has been submitted and is waiting for staff approval.
                            </p>

                        @elseif($booking->status === 'approved')

                            <p class="text-sm text-slate-500 leading-relaxed">
                                Your reservation has been approved. Your vehicle is now reserved.
                            </p>

                        @elseif($booking->status === 'completed')

                            <p class="text-sm text-slate-500 leading-relaxed">
                                This rental has been completed successfully.
                            </p>

                        @elseif($booking->status === 'rejected')

                            <p class="text-sm text-slate-500 leading-relaxed">
                                This reservation request was not approved.
                            </p>

                        @endif

                    </div>


                    <!-- Price Summary -->
                    <div class="py-5">

                        <div class="flex justify-between text-sm mb-2">

                            <span class="text-slate-500">
                                Rental Duration
                            </span>

                            <span class="font-bold text-slate-800">
                                {{ $booking->total_days }} Days
                            </span>

                        </div>


                        <div class="flex justify-between items-end">

                            <span class="font-bold text-slate-900">
                                Total
                            </span>

                            <span class="text-2xl font-extrabold text-indigo-600">
                                ${{ number_format($booking->total_price, 2) }}
                            </span>

                        </div>

                    </div>


                    <!-- Back Button -->
                    <a
                        href="{{ route('home') }}"
                        class="w-full inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-5 rounded-xl shadow-sm transition"
                    >
                        ← Back to Fleet
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection