<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return view('book.book-table');
    }

    public function show(Book $book = null)
    {
        $authors = Author::all();
        $categories = Category::all();
        return view('book.book-form', compact('authors', 'categories', 'book'));
    }

    public function store(Request $request, Book $book = null)
    {
        $request->validate([
            'title' => 'required',
            'author_id' => 'nullable|exists:authors,id',
            'category_id' => 'nullable|exists:categories,id',
            'publisher' => 'nullable',
            'published_date' => 'nullable|date',
            'description' => 'required',
            'page_count' => 'nullable|numeric',
            'price' => 'nullable|numeric',
        ]);

        $book = Book::updateOrCreate([
            'id' => $book->id ?? null],
            $request->all('title', 'author_id', 'category_id', 'publisher', 'published_date', 'description', 'page_count', 'price'));

        if($request->get('remove_image')){
            $book->image()->delete();
        }
        if ($request->hasFile('image')) {
            $book->image()->delete();
            $book->saveImage($request->file('image'));
        }

        return redirect()->route('book.index')->with('success', 'تمت الاضافة بنجاح');
    }

}
