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
        return view('category.category-form', compact('category'));
    }

    public function store(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $category->updateOrCreate([
            'id' => $category->id
        ], [
            $request->all('name', 'description')
        ]);

        if ($request->get('remove_image')) {
            $category->image()->delete();
        }
        if ($request->hasFile('image')) {
            $category->image()->delete();
            $category->saveImage($request->file('image'));
        }
    }
}

