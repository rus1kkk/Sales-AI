<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;
use App\Jobs\GenerateBotResponse;
use Illuminate\Support\Facades\Http;

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

        GenerateBotResponse::dispatch($message); //запуск ответа от ИИ

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => 'Message sent!']);
    }

    public function storeWithAIResponse(Request $request)
    {
        $validated = $request->validate([
            'id_chat' => 'required|integer|exists:chats,id_chat',
            'id_user' => 'required|integer|exists:users,id_user',
            'message_text' => 'required|string',
        ]);

        $userMessage = Message::create([
            'id_chat' => $validated['id_chat'],
            'id_user' => $validated['id_user'],
            'message_type' => 'user',
            'message_text' => $validated['message_text'],
            'created_at' => now(),
        ]);

        $prompt = "Пользователь спросил: {$validated['message_text']}";

        try {
            \Log::info('Запрос к Ollama начинается');

            $response = Http::withOptions(['stream' => true])->post('http://localhost:11434/api/generate', [
                'model' => 'lakomoor/vikhr-llama-3.2-1b-instruct:1b',
                'prompt' => $prompt,
                'max_tokens' => 512,
                'temperature' => 0.3,
            ]);

            if (!$response->ok()) {
                \Log::error('Ошибка ответа от Ollama: ' . $response->body());
                return response()->json(['error' => 'Ошибка при обращении к Ollama'], 500);
            }

            $stream = $response->getBody();

            $buffer = '';
            $aiText = '';

            while (!$stream->eof()) {
                $chunk = $stream->read(1024);  // читаем по 1024 байта
                $buffer .= $chunk;

                // Разбиваем буфер по строкам
                $lines = explode("\n", $buffer);

                // Последняя строка может быть неполной — оставляем её в буфере
                $buffer = array_pop($lines);

                foreach ($lines as $line) {
                    $line = trim($line);
                    if ($line === '')
                        continue;

                    $json = json_decode($line, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        \Log::warning('Не удалось распарсить строку из потока Ollama: ' . $line);
                        continue;
                    }

                    if (isset($json['response'])) {
                        $aiText .= $json['response'];
                    }

                    if (!empty($json['done']) && $json['done'] === true) {
                        break 2; // выход из двух циклов — поток завершён
                    }
                }
            }

            if (empty($aiText)) {
                \Log::error('Ollama вернул пустой ответ после объединения');
                return response()->json(['error' => 'Ollama не вернул текст'], 500);
            }

            \Log::info('Ответ от Ollama успешно собран');

        } catch (\Throwable $e) {
            \Log::error('Исключение при вызове Ollama: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return response()->json(['error' => 'Ошибка во время запроса к Ollama'], 500);
        }

        $botMessage = Message::create([
            'id_chat' => $validated['id_chat'],
            'id_user' => 77777,
            'message_type' => 'ai',
            'message_text' => $aiText,
            'timestamp' => now(),
        ]);

        broadcast(new MessageSent($botMessage))->toOthers();

        return response()->json(['status' => 'ok']);
    }


}
