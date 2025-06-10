<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ChatController extends Controller
{
    // Display list of recent chats
    public function index()
    {
        $chats = [
            [
                'id' => 1,
                'with' => 'Alice',
                'last_message' => 'Hey, did you recycle that plastic today?',
                'time' => '10:30 AM'
            ],
            [
                'id' => 2,
                'with' => 'Bob',
                'last_message' => 'I have some cardboard to sell.',
                'time' => 'Yesterday'
            ],
            [
                'id' => 3,
                'with' => 'Charlie',
                'last_message' => 'Thanks for the pickup!',
                'time' => '2 days ago'
            ]
        ];

        return view('chats.index', compact('chats'));
    }

public function show($id)
{
    // You can map chat ID to usernames later via DB
    $chatUser = match ($id) {
        1 => 'Alice',
        2 => 'Bob',
        3 => 'Charlie',
        default => 'Unknown User',
    };

    // Load messages from DB
    $messages = Message::where('chat_id', $id)->orderBy('created_at')->get()->map(function ($msg) {
        return [
            'sender' => $msg->sender,
            'content' => $msg->content,
            'time' => $msg->created_at->format('g:i A'),
        ];
    })->toArray();

    return view('chats.show', compact('chatUser', 'messages', 'id'));
}
}