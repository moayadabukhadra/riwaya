<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookMark;
use App\Models\BookMarkType;
use App\Models\User;
use Auth;
use Illuminate\Contracts\Auth\Authenticatable;

class BookMarkController extends Controller
{


    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'يجب تسجيل الدخول اولا'], 401);
        }
        $bookmarks = $user->bookmarkedBooks();

        return response()->json(['success' => $bookmarks], 201);
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

    public function updateBookFavorite(Book $book)
    {
        $user = Auth::user();

        if ($user->favoriteBooks()->where('book_id', $book->id)->exists()) {
            $user->favoriteBooks()->where('book_id', $book->id)->delete();
            $response_message = 'تم الحذف من المفضلة';
        } else {
            $user->bookmarkedBooks()->create([
                'book_id' => $book->id,
                'bookmark_type_id' => BookMarkType::TYPES['favorite'],
            ]);
            $response_message = 'تم الإضافة الى المفضلة بنجاح';
        }

        return response()->json(['success' => $response_message]);
    }

    public function updateToReadLater(Book $book)
    {
        $user = Auth::user();

        if ($user->toReadLater()->where('book_id', $book->id)->exists()) {
            $user->toReadLater()->where('book_id', $book->id)->delete();
            $response_message = 'تم الحذف من قراءته لاحقا';
        } else {
            $user->bookmarkedBooks()->create([
                'book_id' => $book->id,
                'bookmark_type_id' => BookMarkType::TYPES['to_read_later'],
            ]);
            $response_message = 'تم الإضافة لقراءته لاحقا';
        }

        return response()->json(['success' => $response_message]);
    }

    public function updateToDoneReading(Book $book)
    {
        $user = Auth::user();

        if ($user->doneReading()->where('book_id', $book->id)->exists()) {
            $user->doneReading()->where('book_id', $book->id)->delete();
            $response_message = 'تم الحذف من تمت قراءته';
        } else {
            $user->bookmarkedBooks()->create([
                'book_id' => $book->id,
                'bookmark_type_id' => BookMarkType::TYPES['done_reading'],
            ]);
            $response_message = 'تم الإضافة الى تمت قراءته';
        }
        
        return response()->json(['success' => $response_message]);
    }
}
