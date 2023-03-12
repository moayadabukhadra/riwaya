<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $request->get('paginate') ?? false;
        if($paginate){
            $with = $request->get('with') ? explode(',', $request->query('with')) : null ;
            $query_string = $request->get('query') ?? null;
            $selected_parent = $request->get('parent_id') ?? null;

            $categories = Category::when($with, function ($query) use ($with) {
                $query->with($with);
            })->when($selected_parent, function ($query) use ($selected_parent) {
                $query->where('parent_id', $selected_parent);
            })->when($query_string, function ($query) use ($query_string) {
                $query->where('name', 'like', '%' . $query_string . '%');
            })->paginate($paginate);
        }else{
            $categories = Category::all();
        }
        return response()->json($categories,200,[],JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category = Category::create($request->all('name', 'description', 'parent_id'));

        if($request->hasFile('image')) {
            $category->saveImage($request->file('image'));
        }

        return response()->json($category, 201, [], JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json($category->load(['image','parent']),200,[],JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( Category $category,Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category->update($request->all('name', 'description', 'parent_id'));

        if($request->has('remove_image')){
            $category->image()->delete();
        }
        if($request->hasFile('image')) {
            $category->saveImage($request->file('image'));
        }

        return response()->json($category, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
$category->delete();

        return response()->json(null, 204);
    }
}
