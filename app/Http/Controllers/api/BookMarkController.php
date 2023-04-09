<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\BookMark;
use App\Models\User;

class BookMarkController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        if (!$user) {
            return response()->json(['error' => 'يجب تسجيل الدخول اولا'], 401);
        }
        $bookmarks = $user->bookmarkedBooks();

        return response()->json(['success' => $bookmarks], 201);
    }

    public function favoriteBooks()
    {
        $user = \Auth::user();
        if (!$user) {
            return response()->json(['error' => 'يجب تسجيل الدخول اولا'], 401);
        }
        $bookmarks = $user->favoriteBooks();

        return response()->json(['success' => $bookmarks], 201);
    }

    public function toReadLaterBooks()
    {
        $user = \Auth::user();
        if (!$user) {
            return response()->json(['error' => 'يجب تسجيل الدخول اولا'], 401);
        }
        $bookmarks = $user->toReadLater();

        return response()->json(['success' => $bookmarks], 201);
    }

    public function doneReadingBooks()
    {
        $user = \Auth::user();
        if (!$user) {
            return response()->json(['error' => 'يجب تسجيل الدخول اولا'], 401);
        }
        $bookmarks = $user->doneReading();

        return response()->json(['success' => $bookmarks], 201);
    }
}
