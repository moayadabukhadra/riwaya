<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        $new_book = Book::updateOrCreate([
            'id' => $book->id ?? null],
            $request->all('title', 'author_id', 'category_id', 'publisher', 'published_date', 'description', 'page_count', 'price'));

        if($request->get('remove_image')){
            $new_book->image()->delete();
        }
        if ($request->hasFile('image')) {
            $new_book->image()->delete();
            $new_book->saveImage($request->file('image'));
        }

        if($request->hasFile('book_file')){
            $file_name = Str::random(10) . '.' . $request->file('book_file')->getClientOriginalExtension();
            $request->file('book_file')->storeAs('public/books', $file_name);
            $new_book->update(['file' => $file_name]);
        }

        return redirect()->route('book.index')->with('success', 'تمت الاضافة بنجاح');
    }

}
