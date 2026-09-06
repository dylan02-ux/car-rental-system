<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen">
    <nav class="bg-white border-b border-slate-200 px-6 py-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">CarRental</a>
        <div class="space-x-4 flex items-center">
            <a href="{{ route('home') }}" class="text-slate-600 hover:text-indigo-600 font-medium">Home</a>
            @auth
                <a href="{{ route('admin.cars.index') }}" class="text-slate-600 hover:text-indigo-600">Dashboard</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-slate-600 hover:text-indigo-600">Login</a>
            @endauth
        </div>
    </nav>

    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Welcoming Text Box -->
        <div class="bg-indigo-600 rounded-2xl p-8 mb-6 text-white text-center shadow-lg">
            <h1 class="text-3xl font-extrabold mb-2">Find Your Perfect Ride</h1>
            <p class="text-indigo-100 max-w-xl mx-auto">Explore our premium fleet and filter by category to find what you need.</p>
        </div>

        <!-- Filter Bar Outside Below the Welcoming Box -->
        <div class="bg-white rounded-xl p-4 mb-8 shadow-sm border border-slate-200 flex justify-center">
            <form method="GET" action="{{ route('home') }}" class="flex items-center gap-3 w-full max-w-md">
                <select name="category" class="w-full rounded-lg text-slate-800 border-slate-300 px-4 py-2 focus:ring-2 focus:ring-indigo-400 border">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-700 transition whitespace-nowrap">Filter</button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($cars as $car)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-slate-100 flex flex-col">
                    @if($car->image)
                        <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->brand }}" class="w-full h-48 object-cover">
                    @endif
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-bold text-slate-900">{{ $car->brand }} {{ $car->model }}</h3>
                                <span class="bg-indigo-50 text-indigo-700 text-xs font-semibold px-2.5 py-1 rounded-full">{{ $car->category->name ?? 'Vehicle' }}</span>
                            </div>
                            <p class="text-slate-500 text-sm mb-4">{{ $car->year }} &middot; {{ ucfirst($car->color ?? 'Standard') }} &middot; {{ $car->seats ?? 4 }} Seats</p>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                            <div>
                                <span class="text-xl font-bold text-indigo-600">${{ number_format($car->daily_rate ?? 50, 2) }}</span>
                                <span class="text-slate-400 text-xs">/ day</span>
                            </div>
                            <div class="space-x-2">
                                <a href="{{ route('cars.show', $car) }}" class="text-slate-600 hover:text-slate-900 text-sm font-medium">Details</a>
                                <a href="{{ route('bookings.checkout', $car) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">Rent</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 text-slate-500 bg-white rounded-xl border border-slate-100">
                    No cars found in this category.
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>
