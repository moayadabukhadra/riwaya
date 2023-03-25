<?php

namespace App\Http\Controllers\api;

use App\Events\NewComment;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function bookComments(Book $book)
    {
        return $book->comments()->with(['user','replies'])->get();
    }

    public function store(Request $request, Book $book)
    {
       $user = \auth('api')->user();


        $request->validate([
            'body' => 'required',
        ]);


        $comment = Comment::create([
            'commentable_id' => $request->get('parent_id') ? null : $book->id,
            'commentable_type' => $request->get('parent_id') ? null : Book::class,
            'body' => $request->get('body'),
            'parent_id' => $request->get('parent_id') ?? null,
            'user_id' => $user->id,
        ]);

        if ($comment->parent_id) {
            $parent = $comment->parent;
            NewComment::dispatch($comment->load(['user','replies']), $parent->user);
        }

        return response()->json([
            'message' => 'تم اضافة التعليق بنجاح',
            'comment' => $comment,
        ]);
    }





}
