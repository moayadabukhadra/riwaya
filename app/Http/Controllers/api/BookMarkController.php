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

    protected Authenticatable|null|User $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function index()
    {
        if (!$this->user) {
            return response()->json(['error' => 'يجب تسجيل الدخول اولا'], 401);
        }
        $bookmarks = $this->user->bookmarkedBooks();

        return response()->json(['success' => $bookmarks], 201);
    }

    public function favoriteBooks()
    {
        if (!$this->user) {
            return response()->json(['error' => 'يجب تسجيل الدخول اولا'], 401);
        }
        $bookmarks = $this->user->favoriteBooks();

        return response()->json(['success' => $bookmarks], 201);
    }

    public function toReadLaterBooks()
    {
        if (!$this->user) {
            return response()->json(['error' => 'يجب تسجيل الدخول اولا'], 401);
        }
        $bookmarks = $this->user->toReadLater();

        return response()->json(['success' => $bookmarks], 201);
    }

    public function doneReadingBooks()
    {
        if (!$this->user) {
            return response()->json(['error' => 'يجب تسجيل الدخول اولا'], 401);
        }
        $bookmarks = $this->user->doneReading();

        return response()->json(['success' => $bookmarks], 201);
    }

    public function addToFavorite(Book $book)
    {
        $user = Auth::user();
        if ($user->favoriteBooks()->where('book_id', $book->id)->exists()) {
            $user->favoriteBooks()->where('book_id', $book->id)->delete();
            $response_message = 'تم الحذف من المفضلة';
        } else {
            $user->favoriteBooks()->create([
                'book_id' => $book->id,
                'bookmark_type_id' => BookMarkType::TYPES['favorite'],
            ]);

            $response_message = 'تم الإضافة الى المفضلة بنجاح';
        }


        return response()->json(['success' => $response_message]);
    }

    public function addToReadLater(Book $book)
    {
        $this->user->favoriteBooks()->create([
            'book_id' => $book->id,
            'bookmark_type_id' => BookMarkType::TYPES['to_read_later'],
        ]);

        return response()->json(['success' => 'تم الإضافة لقراءته لاحقا']);
    }

    public function addToDoneReading(Book $book)
    {
        $this->user->favoriteBooks()->create([
            'book_id' => $book->id,
            'bookmark_type_id' => BookMarkType::TYPES['done_reading'],
        ]);

        return response()->json(['success' => 'تم الإضافة الى تمت قراءته']);
    }
}
