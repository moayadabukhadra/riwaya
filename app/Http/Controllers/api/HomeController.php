<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('search');
        $books = Book::where('title', 'like', "%{$query}%")->take(10)->get();
        $authors = Author::where('name', 'like', "%{$query}%")->take(10)->get();

        return response()->json([
            'books' => $books,
            'authors' => $authors
        ], 200, [], JSON_PRETTY_PRINT);
    }
}
