@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="mb-6">
        <a href="{{ route('home') }}" class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center gap-1 text-sm">
            &larr; Back to Fleet
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
            
            {{-- Vehicle Image Display --}}
            <div>
                @if($car->image && Storage::disk('public')->exists($car->image))
                    <img src="{{ Storage::url($car->image) }}" alt="{{ $car->brand }} {{ $car->model }}" class="w-full h-96 object-cover rounded-xl shadow-inner">
                @else
                    <div class="w-full h-96 bg-slate-100 rounded-xl flex items-center justify-center">
                        <span class="text-slate-400 font-medium text-lg">No Image Available</span>
                    </div>
                @endif
            </div>

            {{-- Vehicle Info & Actions --}}
            <div class="flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="bg-indigo-50 text-indigo-700 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider">
                            {{ $car->category->name }}
                        </span>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $car->status === 'available' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">
                            {{ ucfirst($car->status) }}
                        </span>
                    </div>

                    <h1 class="text-3xl font-extrabold text-slate-900 mb-2">{{ $car->brand }} {{ $car->model }}</h1>
                    <p class="text-3xl font-extrabold text-indigo-600 mb-6">${{ number_format($car->daily_rate, 2) }} <span class="text-slate-400 text-sm font-normal">/ day</span></p>

                    <div class="grid grid-cols-2 gap-4 py-4 border-t border-b border-slate-100 mb-6 text-sm">
                        <div>
                            <span class="text-slate-400 block">Year</span>
                            <span class="font-semibold text-slate-800">{{ $car->year }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block">Color</span>
                            <span class="font-semibold text-slate-800">{{ $car->color }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block">Seats</span>
                            <span class="font-semibold text-slate-800">{{ $car->seats }} Seats</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block">Transmission</span>
                            <span class="font-semibold text-slate-800">{{ ucfirst($car->transmission) }}</span>
                        </div>
                    </div>

                    @if($car->description)
                        <div class="mb-6">
                            <h3 class="text-sm font-semibold text-slate-700 mb-1">Description</h3>
                            <p class="text-slate-600 text-sm leading-relaxed">{{ $car->description }}</p>
                        </div>
                    @endif
                </div>

                {{-- Action Area --}}
                <div class="pt-4 border-t border-slate-100">
                    @if($car->status === 'available')
                        <a href="{{ route('bookings.checkout', $car) }}" class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white text-center font-bold py-3.5 px-4 rounded-xl shadow-sm transition-colors">
                            Rent This Vehicle
                        </a>
                    @else
                        <button disabled class="block w-full bg-slate-200 text-slate-500 text-center font-bold py-3.5 px-4 rounded-xl cursor-not-allowed">
                            Currently Rented / Unavailable
                        </button>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection