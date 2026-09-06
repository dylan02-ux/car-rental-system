<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::with('category');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $cars = $query->get();
        $categories = Category::all();

        return view('home', compact('cars', 'categories'));
    }

    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }
}