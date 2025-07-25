<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DifyController extends Controller
{
    public function chat(Request $request)
    {
        $query = $request->input('message');
        $conversationId = $request->input('conversation_id', '');
        $user = $request->input('user', 'user-123'); 

        $response = Http::withHeaders([
            'Authorization' => 'Bearer app-u3nutAjDq05PcSGE4Auc8NV5',
            'Content-Type' => 'application/json',
        ])->post('https://api.dify.ai/v1/chat-messages', [
            'inputs' => new \stdClass(),
            'query' => $query,
            'response_mode' => 'blocking',
            'conversation_id' => $conversationId,
            'user' => $user,
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => $response->body()], $response->status());
        }
    }
} 