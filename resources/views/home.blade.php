<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CarRental</title>

    <script src="https://cdn.tailwindcss.com"></script>

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

        .car-card-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }
    </style>

</head>


<body class="min-h-screen text-slate-800">

    <!-- Navigation -->
    <nav class="bg-white/95 backdrop-blur-md border-b border-white/80 sticky top-0 z-50 shadow-sm">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="h-16 flex justify-between items-center">

                <!-- Logo -->
                <a
                    href="{{ route('home') }}"
                    class="flex items-center gap-3"
                >

                    <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white text-xl shadow-sm">
                        🚗
                    </div>

                    <div>
                        <div class="text-lg font-extrabold text-slate-900 leading-tight">
                            CarRental
                        </div>

                        <div class="text-[10px] uppercase tracking-widest text-slate-400 font-bold">
                            Drive Your Way
                        </div>
                    </div>

                </a>


                <!-- Navigation Links -->
                <div class="flex items-center gap-5">

                    <a
                        href="{{ route('home') }}"
                        class="text-indigo-600 font-semibold text-sm"
                    >
                        Home
                    </a>


                    @auth

                        @if(auth()->user()->role === 'admin')

                            <a
                                href="{{ route('admin.dashboard') }}"
                                class="text-slate-600 hover:text-indigo-600 font-medium text-sm transition"
                            >
                                Dashboard
                            </a>

                        @endif


                        <form
                            action="{{ route('logout') }}"
                            method="POST"
                            class="flex items-center m-0"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium text-sm px-4 py-2 rounded-lg transition"
                            >
                                Logout
                            </button>

                        </form>

                    @else

                        <a
                            href="{{ route('login') }}"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm px-5 py-2.5 rounded-xl shadow-sm transition"
                        >
                            Login
                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </nav>


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">


        <!-- Welcome / Hero Section -->
        <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-indigo-600 to-blue-600 shadow-xl mb-8">

            <!-- Decorative Background -->
            <div class="absolute -top-20 -right-20 w-72 h-72 bg-white/10 rounded-full"></div>

            <div class="absolute -bottom-32 -left-20 w-80 h-80 bg-blue-400/20 rounded-full"></div>


            <div class="relative px-8 py-14 sm:px-12 sm:py-16 lg:px-16">

                <div class="max-w-2xl">

                    <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 rounded-full px-4 py-2 mb-6">

                        <span class="w-2 h-2 bg-emerald-300 rounded-full"></span>

                        <span class="text-indigo-50 text-xs font-semibold uppercase tracking-wider">
                            Vehicles Available Today
                        </span>

                    </div>


                    <h1 class="text-4xl sm:text-5xl font-extrabold text-white leading-tight">

                        Find Your Perfect
                        <span class="text-indigo-200">
                            Ride.
                        </span>

                    </h1>


                    <p class="text-indigo-100 text-base sm:text-lg mt-5 max-w-xl leading-relaxed">

                        Choose from our available vehicles and find the right car
                        for your next journey.

                    </p>


                    <a
                        href="#fleet"
                        class="inline-flex items-center gap-2 mt-8 bg-white text-indigo-600 hover:bg-indigo-50 font-bold px-6 py-3 rounded-xl shadow-sm transition"
                    >
                        Browse Vehicles

                        <span>
                            ↓
                        </span>

                    </a>

                </div>

            </div>

        </section>


        <!-- Fleet Header -->
        <section id="fleet" class="scroll-mt-24">

            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-5 mb-6">

                <div>

                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-500 mb-2">
                        Our Fleet
                    </p>

                    <h2 class="text-3xl font-extrabold text-slate-900">
                        Available Vehicles
                    </h2>

                    <p class="text-slate-500 mt-2">
                        Browse the fleet or filter vehicles by category.
                    </p>

                </div>


                <!-- Category Filter -->
                <form
                    method="GET"
                    action="{{ route('home') }}"
                    class="bg-white/95 border border-white/80 shadow-sm rounded-2xl p-2 flex items-center gap-2"
                >

                    <select
                        name="category"
                        class="bg-slate-50 border border-slate-200 text-slate-700 rounded-xl px-4 py-2.5 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-indigo-400"
                    >

                        <option value="">
                            All Categories
                        </option>

                        @foreach($categories as $cat)

                            <option
                                value="{{ $cat->id }}"
                                {{ request('category') == $cat->id ? 'selected' : '' }}
                            >
                                {{ $cat->name }}
                            </option>

                        @endforeach

                    </select>


                    <button
                        type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition"
                    >
                        Filter
                    </button>

                </form>

            </div>


            <!-- Cars Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @forelse ($cars as $car)

                    <div class="group bg-white/95 rounded-2xl shadow-sm hover:shadow-xl border border-white/80 overflow-hidden flex flex-col transition-all duration-300 hover:-translate-y-1">

                        <!-- Car Image -->
                        <div class="relative overflow-hidden bg-slate-100">

                            @if($car->image)

                                <img
                                    src="{{ asset('storage/' . $car->image) }}"
                                    alt="{{ $car->brand }} {{ $car->model }}"
                                    class="car-card-image group-hover:scale-105 transition-transform duration-500"
                                >

                            @else

                                <div class="h-[220px] flex items-center justify-center text-slate-400">
                                    No Image Available
                                </div>

                            @endif


                            <!-- Category Badge -->
                            <div class="absolute top-4 left-4">

                                <span class="bg-white/90 backdrop-blur-sm text-indigo-700 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">

                                    {{ $car->category->name ?? 'Vehicle' }}

                                </span>

                            </div>


                            <!-- Availability Badge -->
                            <div class="absolute top-4 right-4">

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
                        <div class="p-6 flex-1 flex flex-col">

                            <div class="flex-1">

                                <h3 class="text-xl font-extrabold text-slate-900">

                                    {{ $car->brand }}
                                    {{ $car->model }}

                                </h3>


                                <div class="flex flex-wrap items-center gap-2 mt-3 text-xs font-medium text-slate-500">

                                    <span class="bg-slate-100 px-2.5 py-1.5 rounded-lg">
                                        {{ $car->year }}
                                    </span>

                                    <span class="bg-slate-100 px-2.5 py-1.5 rounded-lg">
                                        {{ ucfirst($car->color ?? 'Standard') }}
                                    </span>

                                    <span class="bg-slate-100 px-2.5 py-1.5 rounded-lg">
                                        {{ $car->seats ?? 4 }} Seats
                                    </span>

                                </div>

                            </div>


                            <!-- Price -->
                            <div class="mt-6 pt-5 border-t border-slate-100">

                                <div class="flex items-end justify-between gap-4">

                                    <div>

                                        <p class="text-xs text-slate-400 font-medium mb-1">
                                            Starting from
                                        </p>

                                        <div>

                                            <span class="text-2xl font-extrabold text-indigo-600">
                                                ${{ number_format($car->daily_rate ?? 50, 2) }}
                                            </span>

                                            <span class="text-slate-400 text-sm">
                                                / day
                                            </span>

                                        </div>

                                    </div>


                                    <!-- Actions -->
                                    <div class="flex items-center gap-2">

                                        <a
                                            href="{{ route('cars.show', $car) }}"
                                            class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2.5 rounded-xl text-sm font-semibold transition"
                                        >
                                            Details
                                        </a>


                                        @if($car->status === 'available')

                                            <a
                                                href="{{ route('bookings.checkout', $car) }}"
                                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition"
                                            >
                                                Rent
                                            </a>

                                        @else

                                            <span class="bg-slate-100 text-slate-400 px-4 py-2.5 rounded-xl text-sm font-semibold cursor-not-allowed">
                                                Unavailable
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-span-full bg-white/95 rounded-2xl border border-white/80 shadow-sm py-16 px-6 text-center">

                        <div class="text-4xl mb-4">
                            🚗
                        </div>

                        <h3 class="text-lg font-bold text-slate-900">
                            No vehicles found
                        </h3>

                        <p class="text-slate-500 text-sm mt-2">
                            There are currently no cars available in this category.
                        </p>

                        @if(request('category'))

                            <a
                                href="{{ route('home') }}"
                                class="inline-flex mt-5 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 font-semibold px-5 py-2.5 rounded-xl transition"
                            >
                                View All Vehicles
                            </a>

                        @endif

                    </div>

                @endforelse

            </div>

        </section>

    </main>


    <!-- Footer -->
    <footer class="mt-12 bg-white/80 border-t border-white">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-7 flex flex-col sm:flex-row justify-between items-center gap-3">

            <div class="flex items-center gap-2 font-bold text-slate-700">

                <span>
                    🚗
                </span>

                CarRental

            </div>

            <p class="text-xs text-slate-400">
                &copy; {{ date('Y') }} CarRental System. All rights reserved.
            </p>

        </div>

    </footer>

</body>

</html>