<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index(Request $request)
    {

        $with = $request->get('with') ? explode(',', $request->query('with')) : null;
        $query_string = $request->get('query') ?? null;
        $selected_category = $request->get('category') ?? null;
        $selected_author = $request->get('author') ?? null;
        $selected_book = $request->get('selected_book') ?? null;

        $books = [];
        $books['latest_books'] = Book::when($with, function ($query) use ($with) {
            $query->with($with);
        })->latest()->take(10)->get();

        $books['most_selling'] = Book::when($with, function ($query) use ($with) {
            $query->with($with);
        })->orderBy('sell_count', 'desc')->take(10)->get();

        if ($selected_author) {
            $books['related_books'] = Book::when($with, function ($query) use ($with) {
                $query->with($with);
            })->where('author_id', $selected_author)->get();
        }

        if ($selected_category) {
            $books['category_books'] = Book::when($with, function ($query) use ($with) {
                $query->with($with);
            })->where('category_id', $selected_category)->get();
        }

        if ($query_string) {
            $books['books'] = Book::search($query_string)
                ->when($selected_category, function ($query) use ($selected_category) {
                    $query->where('category_id', $selected_category);
                })->when($selected_author, function ($query) use ($selected_author) {
                    $query->where('author_id', $selected_author);
                })->get();
        }
        if ($selected_book) {
            $selected_book = Book::find($selected_book);
            $books['related_books'] = Book::with($with)->where('author_id', $selected_book->author_id)->where('id', '!=', $selected_book->id)->get();
        }

        $books['books'] = Book::when($with, function ($query) use ($with) {
            $query->with($with);
        })->when($selected_category, function ($query) use ($selected_category) {
            $query->where('category_id', $selected_category);
        })->when($selected_author, function ($query) use ($selected_author) {
            $query->where('author_id', $selected_author);
        })->get();


        return response()->json($books, 200, [], JSON_PRETTY_PRINT);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        //
    }

    public function show(Book $book)
    {
        return response()->json($book->load(['image', 'category', 'author']), 200, [], JSON_PRETTY_PRINT);
    }

    public function edit(Book $book)
    {

    }

    public function update(Request $request, Book $book)
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

        $book->update($request->all('title', 'author_id', 'category_id', 'publisher', 'published_date', 'description', 'page_count', 'price'));

        if ($request->hasFile('image')) {
            $book->saveImage($request->file('image'));
        }
        return response()->json($book, 200, [], JSON_PRETTY_PRINT);
    }

    public function latest()
    {
        $books = Book::with(['image', 'author', 'category'])->latest()->take(20)->get();
        return response()->json($books, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(null, 204);
    }
}
