<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Notifications\MessageReply;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        Message::create($request->all('name', 'email', 'message'));


        return response()->json([
            'message' => 'Message sent successfully'
        ], 200, [], JSON_PRETTY_PRINT);

    }
}
