<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {

        $paginate = $request->get('paginate') ?? 10;
        $with = $request->get('with') ? explode(',', $request->query('with')) : null;
        $query_string = $request->get('query') ?? null;
        $selected_category = $request->get('category') ?? null;
        $selected_author = $request->get('author') ?? null;
        $selected_book = $request->get('selected_book') ?? null;


        $books = Book::when($with, function ($query) use ($with) {
            $query->with($with);
        })->where('title', 'like', '%' . $query_string . '%')
            ->orWhere('description', 'like', '%' . $query_string . '%')
            ->orWhereHas('author', function ($query) use ($query_string) {
                $query->where('name', 'like', '%' . $query_string . '%');
            })->when($selected_category, function ($query) use ($selected_category) {
                $query->where('category_id', $selected_category);
            })->when($selected_author, function ($query) use ($selected_author) {
                $query->where('author_id', $selected_author);
            })->paginate($paginate);

        if ($selected_book) {
            $selected_book = Book::find($selected_book);
            $related_books = Book::with($with)->where('author_id', $selected_book->author_id)->where('id', '!=', $selected_book->id)->get();
        }


        return response()->json([
            'books' => $books,
            'related_books' => $related_books ?? null
        ], 200, [], JSON_PRETTY_PRINT);
    }


    public function show(Book $book)
    {
        return response()->json($book->load(['image', 'category', 'author', 'comments']), 200, [], JSON_PRETTY_PRINT);
    }


    public function latest()
    {
        $books = Book::with(['image', 'author', 'category'])->latest()->take(20)->get();
        return response()->json($books, 200, [], JSON_PRETTY_PRINT);
    }

    public function mostRead()
    {
        $books = Book::with(['image', 'author', 'category'])->orderBy('sell_count', 'desc')->take(20)->get();
        return response()->json($books, 200, [], JSON_PRETTY_PRINT);
    }
}
