<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        return view('category.category-table');
    }

    public function show(Category $category = null)
    {
        $categories = Category::all();
        return view('category.category-form', compact('category', 'categories'));
    }

    public function store(Request $request, Category $category = null)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category= Category::updateOrCreate([
            'id' => $category?->id
        ], [
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'parent_id' => $request->get('parent_id'),
        ]);

        if ($request->get('remove_image')) {
            $category->image()->delete();
        }
        if ($request->hasFile('image')) {
            $category->image()->delete();
            $category->saveImage($request->file('image'));
        }

        return redirect()->route('category.index');

    }
}

