<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen">
    <nav class="bg-white border-b border-slate-200 px-6 py-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">CarRental Admin</a>
        <div class="space-x-4 flex items-center">
            <a href="{{ route('home') }}" class="text-slate-600 hover:text-indigo-600 font-medium">Home</a>
            <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 font-medium">Dashboard</a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
            </form>
        </div>
    </nav>

    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold text-slate-900 mb-6">Admin Dashboard</h1>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                <p class="text-sm font-medium text-slate-500">Total Cars</p>
                <p class="text-3xl font-bold text-indigo-600 mt-1">{{ $carCount ?? 0 }}</p>
                <a href="{{ route('admin.cars.index') }}" class="text-xs text-indigo-500 hover:underline mt-2 inline-block">Manage Cars &rarr;</a>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                <p class="text-sm font-medium text-slate-500">Total Bookings</p>
                <p class="text-3xl font-bold text-indigo-600 mt-1">{{ $bookingCount ?? 0 }}</p>
                <a href="{{ route('admin.bookings.index') }}" class="text-xs text-indigo-500 hover:underline mt-2 inline-block">Manage Bookings &rarr;</a>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                <p class="text-sm font-medium text-slate-500">Total Categories</p>
                <p class="text-3xl font-bold text-indigo-600 mt-1">{{ $categoryCount ?? 0 }}</p>
                <a href="{{ route('admin.categories.index') }}" class="text-xs text-indigo-500 hover:underline mt-2 inline-block">Manage Categories &rarr;</a>
            </div>
        </div>

        <!-- Recent Bookings Table -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200">
                <h3 class="text-lg font-bold text-slate-900">Recent Bookings</h3>
            </div>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-600 text-xs uppercase tracking-wider">
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Customer</th>
                        <th class="px-6 py-3">Car</th>
                        <th class="px-6 py-3">Duration</th>
                        <th class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-sm text-slate-700">
                    @forelse($recentBookings as $booking)
                        <tr>
                            <td class="px-6 py-4 font-medium">#{{ $booking->id }}</td>
                            <td class="px-6 py-4">{{ $booking->user->name ?? $booking->guest_name ?? 'Guest' }}</td>
                            <td class="px-6 py-4">{{ $booking->car->brand ?? '' }} {{ $booking->car->model ?? '' }}</td>
                            <td class="px-6 py-4">{{ $booking->total_days ?? 1 }} Days</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700">{{ ucfirst($booking->status ?? 'pending') }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-400">No recent bookings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
