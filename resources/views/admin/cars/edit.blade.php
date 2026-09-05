@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Edit Car</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('admin.cars.update', $car) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $car->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Brand</label>
                    <input type="text" name="brand" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('brand', $car->brand) }}" required>
                    @error('brand')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Model</label>
                    <input type="text" name="model" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('model', $car->model) }}" required>
                    @error('model')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                    <input type="number" name="year" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('year', $car->year) }}" required>
                    @error('year')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Color</label>
                    <input type="text" name="color" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('color', $car->color) }}" required>
                    @error('color')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Seats</label>
                    <input type="number" name="seats" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('seats', $car->seats) }}" required>
                    @error('seats')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Transmission</label>
                    <select name="transmission" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="automatic" {{ $car->transmission == 'automatic' ? 'selected' : '' }}>Automatic</option>
                        <option value="manual" {{ $car->transmission == 'manual' ? 'selected' : '' }}>Manual</option>
                    </select>
                    @error('transmission')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="available" {{ $car->status == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="rented" {{ $car->status == 'rented' ? 'selected' : '' }}>Rented</option>
                        <option value="maintenance" {{ $car->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                    @if($car->image)
                        <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->brand }}" class="h-20 w-20 object-cover rounded mb-2">
                    @endif
                    <input type="file" name="image" class="w-full border-gray-300 rounded-md shadow-sm" accept="image/*">
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="4" class="w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $car->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('admin.cars.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Cancel</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Car</button>
            </div>
        </form>
    </div>
</div>
@endsection