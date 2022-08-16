<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Book::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $book = request()->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);

        $book['image'] = request()->image->store('images', 'public');

        Book::create($book);



        session()->flash('message', 'Book created successfully.');

        return redirect('/create-book');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Book::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'image' => 'nullable',
            'price' => 'nullable',
            'rating' => 'nullable',
        ]);
        $book = Book::findOrFail($id);
        $book->update($request->all());
        return $book;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return '';
    }

    public function search($name)
    {
        return Book::where('title', 'like', '%' . $name . '%')->get();
    }

}
