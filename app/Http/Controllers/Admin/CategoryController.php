<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //displays lsit of all categories
    public function index()
    {
        $categories = Category::withCount('cars')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    //create new category
    public function create()
    {
        return view('admin.categories.create');
    }

    //store new created category in the db
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully');
    }

    //edit an existing category
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    //update a category
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully');
    }

    //delete a category
    public function destroy(Category $category)
    {
        if ($category->cars()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete category with existing cars');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully');
    }
}