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


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">

        <div>

            <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-500 mb-2">
                Category Management
            </p>

            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900">
                Manage Categories
            </h1>

            <p class="text-slate-500 mt-2">
                Organize vehicles into clear categories for easier fleet management.
            </p>

        </div>


        <a
            href="{{ route('admin.categories.create') }}"
            class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-3 rounded-xl shadow-sm transition"
        >
            <span class="text-lg">
                +
            </span>

            Add New Category
        </a>

    </div>


    <!-- Categories Table -->
    <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-sm border border-white/80 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full text-left">

                <thead>

                    <tr class="bg-slate-50/80 text-slate-500 text-xs uppercase tracking-wider">

                        <th class="px-6 py-4 font-semibold">
                            Name
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Description
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Cars Count
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">

                    @forelse($categories as $category)

                        <tr class="hover:bg-slate-50/80 transition-colors">

                            <!-- Name -->
                            <td class="px-6 py-4 whitespace-nowrap">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-lg">
                                        🗂️
                                    </div>

                                    <div class="font-bold text-slate-900">
                                        {{ $category->name }}
                                    </div>

                                </div>

                            </td>


                            <!-- Description -->
                            <td class="px-6 py-4">

                                <div class="text-slate-500 max-w-xl">
                                    {{ $category->description ?: 'No description provided.' }}
                                </div>

                            </td>


                            <!-- Cars Count -->
                            <td class="px-6 py-4 whitespace-nowrap">

                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-100 text-xs font-semibold">

                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>

                                    {{ $category->cars_count }} cars

                                </span>

                            </td>


                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap">

                                <div class="flex items-center gap-2">

                                    <a
                                        href="{{ route('admin.categories.edit', $category) }}"
                                        class="inline-flex items-center justify-center px-3 py-2 rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-100 font-semibold transition"
                                    >
                                        Edit
                                    </a>


                                    <form
                                        action="{{ route('admin.categories.destroy', $category) }}"
                                        method="POST"
                                        class="inline"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            onclick="return confirm('Are you sure you want to delete this category?')"
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
                                colspan="4"
                                class="px-6 py-12 text-center text-slate-400 font-medium"
                            >
                                No categories found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    <!-- Pagination -->
    <div class="mt-6">
        {{ $categories->links() }}
    </div>

</div>

@endsection