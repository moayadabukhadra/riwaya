<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\MessageReply;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        Message::create($request->all('name', 'email', 'message'));

        \Mail::to($request->email)->send(new MessageReply($request->name, $request->email, $request->message));

        return response()->json([
            'message' => 'Message sent successfully'
        ], 200, [], JSON_PRETTY_PRINT);

    }
}