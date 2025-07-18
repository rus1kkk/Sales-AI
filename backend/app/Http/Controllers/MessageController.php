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
        $message = Message::create([
            'id_chat' => $request->id_chat,
            'id_user' => $request->id_user,
            'message_text' => $request->message_text,
            'message_type' => 'user',
            'created_at' => now(),
        ]);

        broadcast(new MessageSent($message))->toOthers();

        // запустить Job, который сгенерирует заглушку
        GenerateBotResponse::dispatch($message);

        return response()->json($message, 201);
    }
}
