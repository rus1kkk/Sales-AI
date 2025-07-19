<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    // Получение истории генераций
    public function history()
    {
        $chats = Chat::orderByDesc('created_at')->get();

        $result = $chats->map(fn($chat) => [
            'id' => $chat->id_chat,
            'name' => $chat->chat_name,
            'chat_status' => $chat->status,
            'date' => $chat->created_at->format('d.m.Y'),
        ]);

        return response()->json($result);
    }

    // Сохранение новой генерации
    public function store(Request $request)
    {
        $validated = $request->validate([
            'chat_name' => 'required|string',
            'id_model' => 'required|exists:models,id_model',
            'chat_status' => 'nullable|in:active,closed,archived',
        ]);

        $chat = Chat::create([
            'chat_name' => $validated['chat_name'],
            'id_model' => $validated['id_model'],
            'chat_status' => $validated['chat_status'] ?? 'active',
            'timestamp' => now(),
        ]);

        return response()->json([
            'message' => 'Чат успешно создан',
            'chat' => $chat,
        ]);
    }

    public function update(Request $request, $id)
    {
        $chat = Chat::findOrFail($id);

        $validated = $request->validate([
            'chat_name' => 'required|string',
        ]);

        $chat->chat_name = $validated['chat_name'];
        $chat->save();

        return response()->json(['message' => 'Название обновлено', 'chat' => $chat]);
    }

    public function destroy($id)
    {
        $chat = Chat::findOrFail($id);
        $chat->delete();

        return response()->json(['message' => 'Чат удален']);
    }
}