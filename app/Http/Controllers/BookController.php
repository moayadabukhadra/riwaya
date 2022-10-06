<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
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
    public function store(Request $request)

    {

        $bookdata=[
            'en'=>[
                'title'=>$request->input('en_title'),
                'author'=>$request->input('en_author'),
                'description'=>$request->input('en_description'),
            ],
            'ar'=>[
                'title'=>$request->input('ar_title'),
                'author'=>$request->input('ar_author'),
                'description'=>$request->input('ar_description'),
            ],
            'image' =>$request->image,
            'price' =>$request->price,
        ];

        $book=Book::create($bookdata);

        foreach ($request->categories as $category_id){

            $category = Category::find($category_id);

            $book->categories()->attach($category);
        }

        return redirect('/dashboard');
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

    public function createBook(){
        return view('create-book-form');
    }

}
