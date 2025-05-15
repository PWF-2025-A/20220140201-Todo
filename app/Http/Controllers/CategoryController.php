<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::where('user_id', auth()->user()->id)
            ->orderBy('title')
            ->paginate(10);

        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:categories,title,NULL,id,user_id,' . auth()->user()->id,
        ]);

        Category::create([
            'user_id' => Auth::id(),
            'title' => ucfirst($request->title),
        ]);

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        if ($category->user_id !== auth()->user()->id) {
            return redirect()->route('category.index')->with('error', 'You are not authorized to edit this category.');
        }

        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        if ($category->user_id !== auth()->user()->id) {
            return redirect()->route('category.index')->with('error', 'You are not authorized to update this category.');
        }

        $request->validate([
            'title' => 'required|string|max:255|unique:categories,title,' . $category->id . ',id,user_id,' . auth()->user()->id,
        ]);

        $category->update([
            'title' => ucfirst($request->title),
        ]);

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->user_id !== auth()->user()->id) {
            return redirect()->route('category.index')->with('error', 'You are not authorized to delete this category.');
        }

        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}