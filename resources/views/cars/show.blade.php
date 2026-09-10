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


<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <!-- Back Link -->
    <div class="mb-6">
        <a
            href="{{ route('home') }}"
            class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-indigo-600 transition"
        >
            <span>←</span>
            Back to Vehicles
        </a>
    </div>


    <!-- Main Car Card -->
    <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-lg border border-white/80 overflow-hidden">

        <div class="grid grid-cols-1 lg:grid-cols-2">

            <!-- Car Image -->
            <div class="relative bg-slate-100 min-h-[360px]">

                @if($car->image)

                    <img
                        src="{{ asset('storage/' . $car->image) }}"
                        alt="{{ $car->brand }} {{ $car->model }}"
                        class="w-full h-full min-h-[360px] object-cover"
                    >

                @else

                    <div class="w-full min-h-[360px] flex items-center justify-center text-slate-400">
                        No Image Available
                    </div>

                @endif


                <!-- Category Badge -->
                <div class="absolute top-5 left-5">

                    <span class="bg-white/90 backdrop-blur-sm text-indigo-700 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">

                        {{ $car->category->name ?? 'Vehicle' }}

                    </span>

                </div>


                <!-- Status Badge -->
                <div class="absolute top-5 right-5">

                    @if($car->status === 'available')

                        <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">

                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>

                            Available

                        </span>

                    @else

                        <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">

                            <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>

                            {{ ucfirst($car->status) }}

                        </span>

                    @endif

                </div>

            </div>


            <!-- Car Information -->
            <div class="p-8 lg:p-10">

                <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-500 mb-3">
                    Vehicle Details
                </p>


                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900">

                    {{ $car->brand ?? '' }}
                    {{ $car->model ?? $car->name }}

                </h1>


                <p class="text-slate-500 mt-3">
                    Review the vehicle information before starting your rental booking.
                </p>


                <!-- Price -->
                <div class="mt-7 p-5 rounded-2xl bg-indigo-50 border border-indigo-100">

                    <p class="text-xs font-semibold uppercase tracking-wider text-indigo-500 mb-1">
                        Rental Price
                    </p>

                    <div>

                        <span class="text-3xl font-extrabold text-indigo-600">
                            ${{ number_format($car->daily_rate ?? $car->price_per_day ?? 50, 2) }}
                        </span>

                        <span class="text-slate-500">
                            / day
                        </span>

                    </div>

                </div>


                <!-- Vehicle Information -->
                <div class="grid grid-cols-2 gap-4 mt-7">

                    <!-- Category -->
                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-4">

                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">
                            Category
                        </p>

                        <p class="font-bold text-slate-800">
                            {{ $car->category->name ?? 'N/A' }}
                        </p>

                    </div>


                    <!-- Year -->
                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-4">

                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">
                            Year
                        </p>

                        <p class="font-bold text-slate-800">
                            {{ $car->year }}
                        </p>

                    </div>


                    <!-- Color -->
                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-4">

                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">
                            Color
                        </p>

                        <p class="font-bold text-slate-800">
                            {{ ucfirst($car->color ?? 'Standard') }}
                        </p>

                    </div>


                    <!-- Transmission -->
                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-4">

                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">
                            Transmission
                        </p>

                        <p class="font-bold text-slate-800">
                            {{ $car->transmission ?? 'Automatic' }}
                        </p>

                    </div>


                    <!-- Seats -->
                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-4">

                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">
                            Seats
                        </p>

                        <p class="font-bold text-slate-800">
                            {{ $car->seats ?? 4 }}
                        </p>

                    </div>


                    <!-- Availability -->
                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-4">

                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">
                            Status
                        </p>

                        <p class="font-bold
                            {{ $car->status === 'available' ? 'text-emerald-600' : 'text-amber-600' }}
                        ">
                            {{ ucfirst($car->status ?? 'available') }}
                        </p>

                    </div>

                </div>


                <!-- Rent Button -->
                <div class="mt-8">

                    @if($car->status === 'available')

                        <a
                            href="{{ route('bookings.checkout', $car->id) }}"
                            class="w-full inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 px-6 rounded-xl shadow-sm transition"
                        >
                            Rent This Vehicle
                        </a>

                    @else

                        <div class="w-full text-center bg-slate-100 text-slate-400 font-bold py-3.5 px-6 rounded-xl cursor-not-allowed">
                            Vehicle Currently Unavailable
                        </div>

                    @endif

                </div>

            </div>

        </div>


        <!-- Description -->
        <div class="border-t border-slate-100 px-8 lg:px-10 py-8">

            <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-500 mb-3">
                About This Vehicle
            </p>

            <h2 class="text-xl font-extrabold text-slate-900 mb-3">
                Description
            </h2>

            <p class="text-slate-600 leading-relaxed max-w-4xl">
                {{ $car->description ?? 'No description available for this vehicle.' }}
            </p>

        </div>

    </div>

</div>

@endsection