<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    // Send a new message
    public function store(Request $request, $chatId)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        Message::create([
            'chat_id' => $chatId,
            'sender' => 'You', // Replace with auth user if available
            'content' => $request->input('content'),
        ]);

        return redirect()->route('chats.show', $chatId);
    }
}
