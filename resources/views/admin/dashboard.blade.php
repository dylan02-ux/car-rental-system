<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

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
    </style>
</head>

<body class="min-h-screen text-slate-800">

    <!-- Navbar -->
    <nav class="bg-white/90 backdrop-blur-md border-b border-slate-200 shadow-sm sticky top-0 z-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="h-16 flex items-center justify-between">

                <a
                    href="{{ route('home') }}"
                    class="flex items-center gap-3"
                >
                    <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center shadow-sm">
                        <span class="text-white text-xl">
                            🚗
                        </span>
                    </div>

                    <div>
                        <p class="text-lg font-extrabold text-slate-900 leading-tight">
                            CarRental
                        </p>

                        <p class="text-xs text-slate-400 font-medium">
                            Employee Portal
                        </p>
                    </div>
                </a>


                <div class="flex items-center gap-2 sm:gap-4">

                    <a
                        href="{{ route('home') }}"
                        class="px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 transition"
                    >
                        Home
                    </a>

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="px-3 py-2 rounded-lg text-sm font-semibold text-indigo-600 bg-indigo-50"
                    >
                        Dashboard
                    </a>

                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                        class="flex items-center m-0"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="px-4 py-2 rounded-lg text-sm font-semibold text-slate-700 bg-slate-100 hover:bg-red-50 hover:text-red-600 transition"
                        >
                            Logout
                        </button>
                    </form>

                </div>

            </div>

        </div>

    </nav>


    <!-- Main Content -->
    <main class="py-10 sm:py-12">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-8">

                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">

                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-500 mb-2">
                            Administration
                        </p>

                        <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900">
                            Admin Dashboard
                        </h1>

                        <p class="text-slate-500 mt-2 max-w-2xl">
                            Manage vehicles, bookings, and categories from one central workspace.
                        </p>
                    </div>

                    <div class="inline-flex items-center gap-2 bg-white border border-slate-200 shadow-sm rounded-xl px-4 py-2">

                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>

                        <span class="text-sm font-medium text-slate-600">
                            System Active
                        </span>

                    </div>

                </div>

            </div>


            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <!-- Total Cars -->
                <a
                    href="{{ route('admin.cars.index') }}"
                    class="group block bg-white/95 backdrop-blur-sm p-6 rounded-2xl shadow-sm border border-white/80 hover:shadow-xl hover:-translate-y-1 transition-all duration-200"
                >

                    <div class="flex items-start justify-between mb-5">

                        <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center">
                            <span class="text-2xl">
                                🚙
                            </span>
                        </div>

                        <span class="text-slate-300 group-hover:text-indigo-500 text-xl transition">
                            →
                        </span>

                    </div>

                    <p class="text-sm font-semibold text-slate-500">
                        Total Cars
                    </p>

                    <p class="text-4xl font-extrabold text-slate-900 mt-1">
                        {{ $carCount ?? 0 }}
                    </p>

                    <p class="text-xs font-medium text-indigo-600 mt-3">
                        Manage vehicle inventory
                    </p>

                </a>


                <!-- Total Bookings -->
                <a
                    href="{{ route('admin.bookings.index') }}"
                    class="group block bg-white/95 backdrop-blur-sm p-6 rounded-2xl shadow-sm border border-white/80 hover:shadow-xl hover:-translate-y-1 transition-all duration-200"
                >

                    <div class="flex items-start justify-between mb-5">

                        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                            <span class="text-2xl">
                                📋
                            </span>
                        </div>

                        <span class="text-slate-300 group-hover:text-indigo-500 text-xl transition">
                            →
                        </span>

                    </div>

                    <p class="text-sm font-semibold text-slate-500">
                        Total Bookings
                    </p>

                    <p class="text-4xl font-extrabold text-slate-900 mt-1">
                        {{ $bookingCount ?? 0 }}
                    </p>

                    <p class="text-xs font-medium text-indigo-600 mt-3">
                        Review rental requests
                    </p>

                </a>


                <!-- Total Categories -->
                <a
                    href="{{ route('admin.categories.index') }}"
                    class="group block bg-white/95 backdrop-blur-sm p-6 rounded-2xl shadow-sm border border-white/80 hover:shadow-xl hover:-translate-y-1 transition-all duration-200"
                >

                    <div class="flex items-start justify-between mb-5">

                        <div class="w-12 h-12 rounded-xl bg-violet-50 flex items-center justify-center">
                            <span class="text-2xl">
                                🗂️
                            </span>
                        </div>

                        <span class="text-slate-300 group-hover:text-indigo-500 text-xl transition">
                            →
                        </span>

                    </div>

                    <p class="text-sm font-semibold text-slate-500">
                        Total Categories
                    </p>

                    <p class="text-4xl font-extrabold text-slate-900 mt-1">
                        {{ $categoryCount ?? 0 }}
                    </p>

                    <p class="text-xs font-medium text-indigo-600 mt-3">
                        Manage vehicle categories
                    </p>

                </a>

            </div>


            <!-- Recent Bookings -->
            <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-sm border border-white/80 overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                    <div>
                        <h2 class="text-lg font-extrabold text-slate-900">
                            Recent Bookings
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Latest rental requests and booking activity.
                        </p>
                    </div>

                    <a
                        href="{{ route('admin.bookings.index') }}"
                        class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-100 text-sm font-semibold transition"
                    >
                        View All Bookings
                    </a>

                </div>


                <div class="overflow-x-auto">

                    <table class="w-full text-left border-collapse">

                        <thead>

                            <tr class="bg-slate-50/80 text-slate-500 text-xs uppercase tracking-wider">

                                <th class="px-6 py-4">
                                    ID
                                </th>

                                <th class="px-6 py-4">
                                    Customer
                                </th>

                                <th class="px-6 py-4">
                                    Car
                                </th>

                                <th class="px-6 py-4">
                                    Duration
                                </th>

                                <th class="px-6 py-4">
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100 text-sm text-slate-700">

                            @forelse($recentBookings as $booking)

                                <tr class="hover:bg-slate-50/80 transition-colors">

                                    <td class="px-6 py-4 font-bold text-slate-900">
                                        #{{ $booking->id }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $booking->user->name ?? $booking->guest_name ?? 'Guest' }}
                                    </td>

                                    <td class="px-6 py-4 font-medium">
                                        {{ $booking->car->brand ?? '' }}
                                        {{ $booking->car->model ?? '' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $booking->total_days ?? 1 }} Days
                                    </td>

                                    <td class="px-6 py-4">

                                        @if(($booking->status ?? 'pending') === 'pending')

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

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="5"
                                        class="px-6 py-12 text-center"
                                    >

                                        <p class="text-slate-400 font-medium">
                                            No recent bookings found.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </main>

</body>
</html>