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

    .checkout-car-image {
        width: 120px;
        height: 90px;
        object-fit: cover;
        border-radius: 14px;
        flex-shrink: 0;
    }

    .checkout-input {
        width: 100%;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        padding: 12px 14px;
        background: #ffffff;
        color: #0f172a;
        transition: 0.2s ease;
    }

    .checkout-input:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
    }
</style>


<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <!-- Back Button -->
    <div class="mb-6">

        <a
            href="{{ route('cars.show', $car) }}"
            class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-indigo-600 transition"
        >
            <span>←</span>

            Back to Vehicle Details
        </a>

    </div>


    <!-- Page Header -->
    <div class="mb-8">

        <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-500 mb-2">
            Rental Checkout
        </p>

        <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900">
            Complete Your Reservation
        </h1>

        <p class="text-slate-500 mt-2">
            Enter your information and rental dates to submit your booking request.
        </p>

    </div>


    <!-- Validation Errors -->
    @if($errors->any())

        <div class="mb-6 bg-red-50 border border-red-200 rounded-2xl px-5 py-4">

            <div class="font-bold text-red-700 text-sm mb-2">
                Please check the information below.
            </div>

            <ul class="text-sm text-red-600 space-y-1">

                @foreach($errors->all() as $error)

                    <li>
                        • {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <!-- Checkout Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">


        <!-- Rental Form -->
        <div class="lg:col-span-2">

            <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-sm border border-white/80 overflow-hidden">

                <!-- Form Header -->
                <div class="px-7 py-6 border-b border-slate-100">

                    <div class="flex items-center gap-3">

                        <div class="w-11 h-11 rounded-xl bg-indigo-50 flex items-center justify-center text-xl">
                            👤
                        </div>

                        <div>

                            <h2 class="text-lg font-extrabold text-slate-900">
                                Customer Information
                            </h2>

                            <p class="text-sm text-slate-400">
                                Enter the details required for the rental.
                            </p>

                        </div>

                    </div>

                </div>


                <form
                    action="{{ route('bookings.storePublic', $car) }}"
                    method="POST"
                    class="p-7"
                >

                    @csrf


                    <!-- Customer Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <!-- Full Name -->
                        <div>

                            <label
                                for="customer_name"
                                class="block text-sm font-semibold text-slate-700 mb-2"
                            >
                                Full Name
                            </label>

                            <input
                                id="customer_name"
                                type="text"
                                name="customer_name"
                                required
                                value="{{ old('customer_name') }}"
                                placeholder="Enter your full name"
                                class="checkout-input"
                            >

                            @error('customer_name')

                                <p class="text-red-500 text-xs mt-1.5">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        <!-- Email -->
                        <div>

                            <label
                                for="customer_email"
                                class="block text-sm font-semibold text-slate-700 mb-2"
                            >
                                Email Address
                            </label>

                            <input
                                id="customer_email"
                                type="email"
                                name="customer_email"
                                required
                                value="{{ old('customer_email') }}"
                                placeholder="example@email.com"
                                class="checkout-input"
                            >

                            @error('customer_email')

                                <p class="text-red-500 text-xs mt-1.5">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        <!-- Phone -->
                        <div>

                            <label
                                for="customer_phone"
                                class="block text-sm font-semibold text-slate-700 mb-2"
                            >
                                Phone Number
                            </label>

                            <input
                                id="customer_phone"
                                type="text"
                                name="customer_phone"
                                required
                                value="{{ old('customer_phone') }}"
                                placeholder="Enter phone number"
                                class="checkout-input"
                            >

                            @error('customer_phone')

                                <p class="text-red-500 text-xs mt-1.5">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        <!-- Address -->
                        <div>

                            <label
                                for="customer_address"
                                class="block text-sm font-semibold text-slate-700 mb-2"
                            >
                                Address
                            </label>

                            <input
                                id="customer_address"
                                type="text"
                                name="customer_address"
                                required
                                value="{{ old('customer_address') }}"
                                placeholder="Enter your address"
                                class="checkout-input"
                            >

                            @error('customer_address')

                                <p class="text-red-500 text-xs mt-1.5">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>


                    <!-- Rental Dates -->
                    <div class="mt-8 pt-7 border-t border-slate-100">

                        <div class="flex items-center gap-3 mb-5">

                            <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-lg">
                                📅
                            </div>

                            <div>

                                <h3 class="font-extrabold text-slate-900">
                                    Rental Period
                                </h3>

                                <p class="text-xs text-slate-400">
                                    Choose your pickup and return dates.
                                </p>

                            </div>

                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            <!-- Start Date -->
                            <div>

                                <label
                                    for="start_date"
                                    class="block text-sm font-semibold text-slate-700 mb-2"
                                >
                                    Start Date
                                </label>

                                <input
                                    id="start_date"
                                    type="date"
                                    name="start_date"
                                    required
                                    min="{{ date('Y-m-d') }}"
                                    value="{{ old('start_date', date('Y-m-d')) }}"
                                    class="checkout-input"
                                >

                                @error('start_date')

                                    <p class="text-red-500 text-xs mt-1.5">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            <!-- End Date -->
                            <div>

                                <label
                                    for="end_date"
                                    class="block text-sm font-semibold text-slate-700 mb-2"
                                >
                                    End Date
                                </label>

                                <input
                                    id="end_date"
                                    type="date"
                                    name="end_date"
                                    required
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                    value="{{ old('end_date', date('Y-m-d', strtotime('+1 day'))) }}"
                                    class="checkout-input"
                                >

                                @error('end_date')

                                    <p class="text-red-500 text-xs mt-1.5">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>

                    </div>


                    <!-- Booking Notice -->
                    <div class="mt-7 bg-amber-50 border border-amber-100 rounded-xl p-4">

                        <div class="flex gap-3">

                            <span class="text-lg">
                                ⏳
                            </span>

                            <div>

                                <p class="text-sm font-bold text-amber-800">
                                    Reservation Request
                                </p>

                                <p class="text-xs text-amber-700 mt-1 leading-relaxed">
                                    Your reservation will be submitted for review.
                                    An employee can approve or reject the rental request.
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- Submit -->
                    <button
                        type="submit"
                        class="mt-7 w-full inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 px-6 rounded-xl shadow-sm transition"
                    >

                        Confirm Reservation

                        <span>
                            →
                        </span>

                    </button>

                </form>

            </div>

        </div>


        <!-- Booking Summary -->
        <div class="lg:col-span-1">

            <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-sm border border-white/80 overflow-hidden lg:sticky lg:top-24">

                <!-- Summary Header -->
                <div class="px-6 py-5 border-b border-slate-100">

                    <p class="text-xs font-bold uppercase tracking-[0.15em] text-indigo-500 mb-1">
                        Your Rental
                    </p>

                    <h2 class="text-lg font-extrabold text-slate-900">
                        Booking Summary
                    </h2>

                </div>


                <!-- Vehicle -->
                <div class="p-6">

                    @if($car->image && Storage::disk('public')->exists($car->image))

                        <img
                            src="{{ Storage::url($car->image) }}"
                            alt="{{ $car->brand }} {{ $car->model }}"
                            class="w-full h-40 object-cover rounded-2xl border border-slate-100"
                        >

                    @else

                        <div class="w-full h-40 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-400 text-sm">
                            No Image Available
                        </div>

                    @endif


                    <div class="mt-5">

                        <div class="flex items-start justify-between gap-3">

                            <div>

                                <h3 class="text-lg font-extrabold text-slate-900">
                                    {{ $car->brand }} {{ $car->model }}
                                </h3>

                                <p class="text-sm text-slate-400 mt-1">
                                    {{ $car->year }}
                                    •
                                    {{ ucfirst($car->transmission ?? 'Automatic') }}
                                </p>

                            </div>


                            <span class="bg-indigo-50 text-indigo-700 text-xs font-bold px-2.5 py-1 rounded-full">
                                {{ $car->category->name ?? 'Vehicle' }}
                            </span>

                        </div>

                    </div>


                    <!-- Vehicle Details -->
                    <div class="mt-5 py-5 border-y border-slate-100 space-y-3">

                        <div class="flex items-center justify-between text-sm">

                            <span class="text-slate-500">
                                Daily Rate
                            </span>

                            <span class="font-bold text-slate-900">
                                ${{ number_format($car->daily_rate, 2) }}
                            </span>

                        </div>


                        <div class="flex items-center justify-between text-sm">

                            <span class="text-slate-500">
                                Status
                            </span>

                            <span class="inline-flex items-center gap-1.5 text-emerald-600 font-semibold">

                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                Available

                            </span>

                        </div>

                    </div>


                    <!-- Price -->
                    <div class="mt-5">

                        <p class="text-xs text-slate-400">
                            Rental price
                        </p>

                        <div class="mt-1">

                            <span class="text-3xl font-extrabold text-indigo-600">
                                ${{ number_format($car->daily_rate, 2) }}
                            </span>

                            <span class="text-sm text-slate-400">
                                / day
                            </span>

                        </div>

                        <p class="text-xs text-slate-400 mt-2">
                            Final total is calculated from your selected rental dates.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection