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

    .car-image {
        width: 90px;
        height: 65px;
        object-fit: cover;
        border-radius: 12px;
        flex-shrink: 0;
    }
</style>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">

        <div>

            <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-500 mb-2">
                Vehicle Management
            </p>

            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900">
                Manage Cars
            </h1>

            <p class="text-slate-500 mt-2">
                Add, update, and manage vehicles available in the rental system.
            </p>

        </div>


        <a
            href="{{ route('admin.cars.create') }}"
            class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-3 rounded-xl shadow-sm transition"
        >
            <span class="text-lg">
                +
            </span>

            Add New Car
        </a>

    </div>


    <!-- Cars Table -->
    <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-sm border border-white/80 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full text-left">

                <thead>

                    <tr class="bg-slate-50/80 text-slate-500 text-xs uppercase tracking-wider">

                        <th class="px-6 py-4 font-semibold">
                            Car
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Category
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Year
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Status
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">

                    @forelse($cars as $car)

                        <tr class="hover:bg-slate-50/80 transition-colors">

                            <!-- Car -->
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-4">

                                    @if($car->image)

                                        <img
                                            src="{{ asset('storage/' . $car->image) }}"
                                            alt="{{ $car->brand }} {{ $car->model }}"
                                            class="car-image border border-slate-200 shadow-sm"
                                        >

                                    @else

                                        <div
                                            class="car-image bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 text-xs"
                                        >
                                            No Image
                                        </div>

                                    @endif


                                    <div>

                                        <div class="font-bold text-slate-900">
                                            {{ $car->brand }} {{ $car->model }}
                                        </div>

                                        <div class="text-sm text-slate-500 mt-0.5">
                                            {{ $car->color }}
                                        </div>

                                    </div>

                                </div>

                            </td>


                            <!-- Category -->
                            <td class="px-6 py-4 whitespace-nowrap">

                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 text-xs font-semibold">
                                    {{ $car->category->name ?? 'Uncategorized' }}
                                </span>

                            </td>


                            <!-- Year -->
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-slate-700">
                                {{ $car->year }}
                            </td>


                            <!-- Status -->
                            <td class="px-6 py-4 whitespace-nowrap">

                                @if($car->status === 'available')

                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">

                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                        Available

                                    </span>

                                @elseif($car->status === 'rented')

                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-100">

                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>

                                        Rented

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-100">

                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>

                                        {{ ucfirst($car->status) }}

                                    </span>

                                @endif

                            </td>


                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap">

                                <div class="flex items-center gap-2">

                                    <a
                                        href="{{ route('admin.cars.edit', $car) }}"
                                        class="inline-flex items-center justify-center px-3 py-2 rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-100 font-semibold transition"
                                    >
                                        Edit
                                    </a>


                                    <form
                                        action="{{ route('admin.cars.destroy', $car) }}"
                                        method="POST"
                                        class="inline"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            onclick="return confirm('Are you sure you want to delete this car?')"
                                            class="inline-flex items-center justify-center px-3 py-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 font-semibold transition"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="px-6 py-12 text-center text-slate-400 font-medium"
                            >
                                No cars found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    <!-- Pagination -->
    <div class="mt-6">
        {{ $cars->links() }}
    </div>

</div>

@endsection