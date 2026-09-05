<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //displays the homepage with available cars
    public function index()
    {
        $cars = Car::with('category')
            ->where('status', 'available')
            ->latest()
            ->paginate(12);
        
        $categories = Category::withCount('cars')->get();
        
        return view('home', compact('cars', 'categories'));
    }
    //displays details of a specific car
    public function show(Car $car)
    {
        $car->load(['category', 'reviews.user']);
        return view('cars.show', compact('car'));
    }

    //displays cars based on user chosen categories
    public function search(Request $request)
    {
        $query = Car::query()->where('status', 'available');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        $cars = $query->with('category')->paginate(12);
        $categories = Category::all();

        return view('home', compact('cars', 'categories'));
    }
}