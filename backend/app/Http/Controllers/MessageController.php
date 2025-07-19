<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;
use App\Jobs\GenerateBotResponse;

class MessageController extends Controller
{
    public function index($chatId)
    {
        return Message::where('id_chat', $chatId)
            ->orderBy('created_at')
            ->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_chat' => 'required|integer|exists:chats,id_chat',
            'id_user' => 'required|integer|exists:users,id_user',
            'message_text' => 'required|string|max:1000',
            'message_type' => 'required|string|in:user,ai,system',
        ]);

        $message = Message::create([
            'id_chat' => $validated['id_chat'],
            'id_user' => $validated['id_user'],
            'message_text' => $validated['message_text'],
            'message_type' => $validated['message_type'],
            'timestamp' => now(),
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => 'Message sent!']);
    }
}
