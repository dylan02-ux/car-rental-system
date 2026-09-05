<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('category')->latest()->paginate(10);
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.cars.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:255',
            'seats' => 'required|integer|min:1',
            'transmission' => 'required|in:automatic,manual',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'description' => 'nullable|string',
            'status' => 'required|in:available,rented,maintenance',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('cars', 'public');
            $validated['image'] = $path;
        }

        Car::create($validated);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car added successfully');
    }

    public function edit(Car $car)
    {
        $categories = Category::all();
        return view('admin.cars.edit', compact('car', 'categories'));
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:255',
            'seats' => 'required|integer|min:1',
            'transmission' => 'required|in:automatic,manual',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'description' => 'nullable|string',
            'status' => 'required|in:available,rented,maintenance',
        ]);

        if ($request->hasFile('image')) {
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }
            $validated['image'] = $request->file('image')->store('cars', 'public');
        }

        $car->update($validated);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car updated successfully');
    }

    public function destroy(Car $car)
    {
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }
        
        $car->delete();

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car deleted successfully');
    }
}