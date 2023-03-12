<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
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
            $authors = Author::when($with, function ($query) use ($with) {
                $query->with($with);
            })->when($query_string, function ($query) use ($query_string) {
                $query->where('name', 'like', '%' . $query_string . '%');
            })->paginate($paginate);
        }else{
            $authors = Author::all();
        }
        return response()->json($authors, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'bio' => 'nullable',
        ]);

        $author = Author::create($request->all('name', 'bio'));

        if($request->hasFile('image')) {
            $author->saveImage($request->file('image'));
        }

        return response()->json($author, 201, [], JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return response()->json($author->load('image'),200,[],JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required',
            'bio' => 'nullable',
        ]);

        $author->update($request->all('name', 'bio'));

        if($request->get('remove_image')) {
            $author->image()->delete();
        }
        if($request->hasFile('image')) {
            $author->saveImage($request->file('image'));
        }

        return response()->json($author, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return response()->json(null, 204);
    }
}
