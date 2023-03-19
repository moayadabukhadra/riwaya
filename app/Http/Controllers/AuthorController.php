<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return view('author.author-table');
    }

    public function show(Author $author = null)
    {
        return view('author.author-form',compact('author'));
    }


    public function store(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required',
            'bio' => 'nullable',
        ]);

        $author= Author::updateOrCreate([
            'id' => $author->id
        ],[
            'name' => $request->name,
            'bio' => $request->bio,
            'country' => $request->country
        ]);

        if($request->get('remove_image')){
            $author->image()->delete();
        }
        if($request->hasFile('image')){
            $author->image()->delete();
            $author->saveImage($request->file('image'));
        }


        return redirect()->route('author.index');
    }

}
