<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RequirementController extends Controller
{
    public function generate(Request $request)
    {
        $clientInput = $request->input('text');

        if (!$clientInput) {
            return response()->json(['error' => 'Запрос пустой'], 400);
        }

        $prompt = "Ты — опытный бизнес-аналитик и технический писатель. На основе следующего запроса клиента:\n\n\"{$clientInput}\"\n\nСформируй максимально подробный список требований к продукту, разделённых на два блока:\n\n1. Функциональные требования — конкретные функции и возможности, которые должен поддерживать продукт.\n2. Нефункциональные требования — качества продукта, включая производительность, безопасность, удобство использования и др.\n\nДля каждого требования:\n- Укажи краткое название\n- Дай подробное описание\n- При необходимости укажи приоритет (высокий, средний, низкий)\n\nОформи результат в виде структурированного списка с заголовками и пунктами. Начни с краткого резюме запроса клиента.";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('AI_API_KEY'),
        ])->withoutVerifying()->post("https://openrouter.ai/api/v1/chat/completions", [
                    "model" => "deepseek/deepseek-chat-v3-0324:free",
                    "messages" => [
                        [
                            "role" => "user",
                            "content" => $prompt,
                        ]
                    ]
                ]);

        if (!$response->ok()) {
            return response()->json(['error' => 'Ошибка от AI'], 500);
        }

        return response()->json([
            'result' => $response->json('choices.0.message.content'),
        ]);
    }
}
