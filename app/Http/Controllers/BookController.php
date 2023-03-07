<?php

namespace App\Http\Controllers;

use App\Models\Book;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index(Request $request)
    {
        $paginate = $request->get('paginate') ?? false;
        if($paginate){
            $with = $request->get('with') ? explode(',', $request->query('with')) : null ;
            $query_string = $request->get('query') ?? null;
            $selected_category = $request->get('category') ?? null;
            $selected_author = $request->get('author') ?? null;

            $books = Book::when($with, function ($query) use ($with) {
                $query->with($with);
            })->when($selected_category, function ($query) use ($selected_category) {
                $query->where('category_id', $selected_category);
            })->when($selected_author, function ($query) use ($selected_author) {
                $query->where('author_id', $selected_author);
            })
                ->when($query_string, function ($query) use ($query_string) {
                    $query->where('title', 'like', '%' . $query_string . '%');
                })->paginate($paginate);
        }else{
            $books = Book::all();
        }


        return response()->json($books, 200, [], JSON_PRETTY_PRINT);

    }

    public function create()
    {

    }

    public function store(Request $request)
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

        $book = Book::create($request->all('title', 'author_id', 'category_id', 'publisher', 'published_date', 'description', 'page_count', 'price'));

        if($request->hasFile('image')) {
            $book->saveImage($request->file('image'));
        }

        return response()->json($book, 201, [], JSON_PRETTY_PRINT);
    }

    public function show(Book $book)
    {
        return response()->json($book->load(['image','category','author']),200,[],JSON_PRETTY_PRINT);
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

        if($request->hasFile('image')) {
            $book->saveImage($request->file('image'));
        }
        return response()->json($book, 200, [], JSON_PRETTY_PRINT);
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
