<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookMark;
use App\Models\BookMarkType;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;

class BookMarkController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'يجب تسجيل الدخول اولا'], 401);
        }
        $bookmarks = $user->bookmarkedBooks()
            ->with(['author', 'category', 'images'])
            ->select('books.*', 'book_marks.bookmark_type_id')
            ->groupBy('book_marks.bookmark_type_id', 'books.id', 'books.title', 'books.author_id', 'books.category_id', 'books.description', 'books.created_at', 'books.updated_at')
            ->get();

        $groupedBookmarks = $bookmarks->groupBy('pivot.bookmark_type_id');




        return response()->json(['success' => $groupedBookmarks], 201);
    }

    public function favoriteBooks()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'يجب تسجيل الدخول اولا'], 401);
        }
        $bookmarks = $user->favoriteBooks();

        return response()->json(['success' => $bookmarks], 201);
    }

    public function toReadLaterBooks()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'يجب تسجيل الدخول اولا'], 401);
        }
        $bookmarks = $user->toReadLater();

        return response()->json(['success' => $bookmarks], 201);
    }

    public function doneReadingBooks()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'يجب تسجيل الدخول اولا'], 401);
        }
        $bookmarks = $user->doneReading();

        return response()->json(['success' => $bookmarks], 201);
    }


    public function store(Book $book, $bookmark_type)
    {
        $user = Auth::user();
        $bookmark_type_id = BookMarkType::TYPES[$bookmark_type];

        if ($user->bookmarks()->where('bookmark_type_id', $bookmark_type_id)->where('book_id', $book->id)->exists()) {
            $user->bookmarks()->where('bookmark_type_id', $bookmark_type_id)->where('book_id', $book->id)->delete();
            $message = 'تم الحذف';
        } else {
            $user->bookmarks()->create([
                'book_id' => $book->id,
                'bookmark_type_id' => $bookmark_type_id
            ]);
            $message = 'تم الاضافة';
        }

        return response()->json(['success' => $message]);
    }

    public function checkBookmarkStatus(Book $book)
    {
        $status = [];
        $user = Auth::user();

        $user->favoriteBooks()->where('book_id', $book->id)->exists() ? $status['favorite'] = true : $status['favorite'] = false;
        $user->toReadLater()->where('book_id', $book->id)->exists() ? $status['to_read_later'] = true : $status['to_read_later'] = false;
        $user->doneReading()->where('book_id', $book->id)->exists() ? $status['done_reading'] = true : $status['done_reading'] = false;

        return response()->json(['status' => $status], 201);
    }
}
