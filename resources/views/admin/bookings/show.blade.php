@extends('layouts.app')

@section('content')

<style>
    body {
        background:
            radial-gradient(circle at 12% 18%, rgba(79, 70, 229, 0.10), transparent 30%),
            radial-gradient(circle at 88% 42%, rgba(59, 130, 246, 0.08), transparent 30%),
            linear-gradient(135deg, #e7edf4 0%, #f4f7fa 48%, #dce6ef 100%);
        background-attachment: fixed;
    }

    /*
     * Explicit CSS is used for these three buttons.
     * This avoids the problem where the Tailwind green
     * background was not appearing.
     */
    .rental-btn {
        display: block;
        width: 100%;
        border: none;
        border-radius: 10px;
        padding: 11px 16px;
        color: #ffffff !important;
        font-size: 14px;
        font-weight: 700;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .rental-btn-approve {
        background-color: #059669 !important;
    }

    .rental-btn-approve:hover {
        background-color: #047857 !important;
    }

    .rental-btn-reject {
        background-color: #dc2626 !important;
    }

    .rental-btn-reject:hover {
        background-color: #b91c1c !important;
    }

    .rental-btn-complete {
        background-color: #2563eb !important;
    }

    .rental-btn-complete:hover {
        background-color: #1d4ed8 !important;
    }
</style>


<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Page Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>

            <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-500 mb-2">
                Rental Management
            </p>

            <h1 class="text-2xl font-bold text-slate-900">
                Booking Details #{{ $booking->id }}
            </h1>

            <p class="text-xs text-slate-400 mt-1">
                Processed by staff: {{ $booking->user->name ?? 'Admin' }}
            </p>

        </div>

        <a
            href="{{ route('admin.bookings.index') }}"
            class="text-slate-600 hover:text-indigo-600 text-sm font-medium transition-colors"
        >
            &larr; Back to Bookings
        </a>

    </div>


    <!-- Success Message -->
    @if(session('success'))

        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm font-medium">
            {{ session('success') }}
        </div>

    @endif


    <!-- Error Message -->
    @if(session('error'))

        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm font-medium">
            {{ session('error') }}
        </div>

    @endif


    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- LEFT SIDE -->
        <div class="md:col-span-2 space-y-6">


            <!-- Customer Information -->
            <div class="bg-white/95 rounded-2xl shadow-sm border border-white/80 p-6">

                <h2 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-5">
                    Customer Information
                </h2>


                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 text-sm">

                    <div>

                        <span class="text-slate-400 block text-xs mb-1">
                            Full Name
                        </span>

                        <span class="font-semibold text-slate-800">
                            {{ $booking->customer_name ?? $booking->user->name ?? 'N/A' }}
                        </span>

                    </div>


                    <div>

                        <span class="text-slate-400 block text-xs mb-1">
                            Email Address
                        </span>

                        <span class="font-semibold text-slate-800">
                            {{ $booking->customer_email ?? $booking->user->email ?? 'N/A' }}
                        </span>

                    </div>


                    <div>

                        <span class="text-slate-400 block text-xs mb-1">
                            Phone Number
                        </span>

                        <span class="font-semibold text-slate-800">
                            {{ $booking->customer_phone ?? 'N/A' }}
                        </span>

                    </div>


                    <div>

                        <span class="text-slate-400 block text-xs mb-1">
                            Physical Address
                        </span>

                        <span class="font-semibold text-slate-800">
                            {{ $booking->customer_address ?? 'N/A' }}
                        </span>

                    </div>

                </div>

            </div>


            <!-- Vehicle Information -->
            <div class="bg-white/95 rounded-2xl shadow-sm border border-white/80 p-6">

                <h2 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-5">
                    Rented Vehicle
                </h2>


                <div class="flex items-center gap-4">

                    @if($booking->car->image && Storage::disk('public')->exists($booking->car->image))

                        <img
                            src="{{ Storage::url($booking->car->image) }}"
                            alt="{{ $booking->car->brand }} {{ $booking->car->model }}"
                            class="w-20 h-20 object-cover rounded-xl border border-slate-100"
                        >

                    @else

                        <div class="w-20 h-20 bg-slate-100 rounded-xl flex items-center justify-center text-xs text-slate-400">
                            No Image
                        </div>

                    @endif


                    <div>

                        <h3 class="text-lg font-bold text-slate-900">
                            {{ $booking->car->brand }}
                            {{ $booking->car->model }}
                        </h3>


                        <p class="text-xs text-slate-500 mt-1">

                            {{ $booking->car->year }}

                            &bull;

                            {{ ucfirst($booking->car->transmission ?? 'Automatic') }}

                            &bull;

                            {{ $booking->car->color }}

                        </p>


                        <p class="text-sm font-bold text-indigo-600 mt-2">
                            ${{ number_format($booking->car->daily_rate, 2) }} / day
                        </p>

                    </div>

                </div>

            </div>

        </div>


        <!-- RIGHT SIDE -->
        <div>

            <div class="bg-white/95 rounded-2xl shadow-sm border border-white/80 p-6">

                <h2 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">
                    Rental Summary
                </h2>


                <!-- Dates -->
                <div class="space-y-3 text-sm pb-4 border-b border-slate-100">

                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Start Date
                        </span>

                        <span class="font-medium text-slate-800 text-right">
                            {{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            End Date
                        </span>

                        <span class="font-medium text-slate-800 text-right">
                            {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-slate-500">
                            Duration
                        </span>

                        <span class="font-medium text-slate-800">
                            {{ $booking->total_days }} Days
                        </span>

                    </div>

                </div>


                <!-- Total -->
                <div class="flex justify-between items-center py-4 border-b border-slate-100">

                    <span class="font-bold text-slate-900">
                        Total Charged
                    </span>

                    <span class="text-xl font-extrabold text-indigo-600">
                        ${{ number_format($booking->total_price, 2) }}
                    </span>

                </div>


                <!-- Current Status -->
                <div class="py-5 border-b border-slate-100">

                    <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                        Current Status
                    </span>


                    @if($booking->status === 'pending')

                        <span class="inline-flex px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-xs font-bold">
                            Pending
                        </span>

                    @elseif($booking->status === 'approved')

                        <span class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold">
                            Approved
                        </span>

                    @elseif($booking->status === 'completed')

                        <span class="inline-flex px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold">
                            Completed
                        </span>

                    @elseif($booking->status === 'rejected')

                        <span class="inline-flex px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                            Rejected
                        </span>

                    @else

                        <span class="inline-flex px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-bold">
                            {{ ucfirst($booking->status) }}
                        </span>

                    @endif

                </div>


                <!-- Status Actions -->
                <div class="pt-5">

                    <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">
                        Update Status
                    </span>


                    <!-- PENDING -->
                    @if($booking->status === 'pending')

                        <div style="display: flex; flex-direction: column; gap: 12px;">

                            <!-- APPROVE -->
                            <form
                                action="{{ route('admin.bookings.approve', $booking->id) }}"
                                method="POST"
                                style="margin: 0;"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="rental-btn rental-btn-approve"
                                >
                                    ✓ Approve Rental
                                </button>

                            </form>


                            <!-- REJECT -->
                            <form
                                action="{{ route('admin.bookings.reject', $booking->id) }}"
                                method="POST"
                                style="margin: 0;"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="rental-btn rental-btn-reject"
                                    onclick="return confirm('Are you sure you want to reject this rental?')"
                                >
                                    ✕ Reject Rental
                                </button>

                            </form>

                        </div>


                    <!-- APPROVED -->
                    @elseif($booking->status === 'approved')

                        <form
                            action="{{ route('admin.bookings.complete', $booking->id) }}"
                            method="POST"
                            style="margin: 0;"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="rental-btn rental-btn-complete"
                                onclick="return confirm('Has the customer returned the vehicle?')"
                            >
                                ✓ Mark as Completed
                            </button>

                        </form>


                    <!-- COMPLETED -->
                    @elseif($booking->status === 'completed')

                        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg px-4 py-3 text-sm font-medium text-center">
                            ✓ Rental completed successfully.
                        </div>


                    <!-- REJECTED -->
                    @elseif($booking->status === 'rejected')

                        <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm font-medium text-center">
                            This rental was rejected.
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection