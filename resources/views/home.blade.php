@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    @if(session('success'))
        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-600 to-indigo-500 mb-10 px-8 py-16 text-center">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_1px_1px,white_1px,transparent_0)] [background-size:20px_20px]"></div>
        <div class="relative">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-white mb-4 tracking-tight">Find Your Perfect Ride</h1>
            <p class="text-lg text-indigo-100">Explore our fleet and call us directly to make a reservation.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($cars as $car)
            <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                @if($car->image && Storage::disk('public')->exists($car->image))
                    <img src="{{ Storage::url($car->image) }}" alt="{{ $car->brand }} {{ $car->model }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-slate-100 flex items-center justify-center">
                        <span class="text-slate-400 text-sm font-medium">No Image Available</span>
                    </div>
                @endif

                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-xl font-bold text-slate-900">{{ $car->brand }} {{ $car->model }}</h3>
                        <span class="bg-indigo-50 text-indigo-700 text-xs font-semibold px-2.5 py-1 rounded-full">{{ $car->category->name ?? 'Vehicle' }}</span>
                    </div>

                    <div class="text-slate-500 mb-4 space-y-1 text-sm">
                        <p>{{ $car->year }} • {{ $car->color }}</p>
                        <p>{{ $car->seats }} Seats • {{ ucfirst($car->transmission) }}</p>
                    </div>

                    <div class="flex items-center justify-between gap-2 border-t pt-4 border-slate-100">
                        <div>
                            <span class="text-2xl font-extrabold text-indigo-600">${{ number_format($car->daily_rate ?? 50, 2) }}</span>
                            <span class="text-slate-500 text-sm">/day</span>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('cars.show', $car) }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-2 px-3 rounded-lg text-xs transition-colors">Details</a>
                            <a href="tel:+1234567890" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-3 rounded-lg text-xs transition-colors flex items-center gap-1">
                                📞 Reserve
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12">
                <p class="text-slate-500 text-xl">No cars available at the moment.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $cars->links() }}
    </div>

</div>
@endsection
