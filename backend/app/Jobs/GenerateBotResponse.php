<?php

namespace App\Jobs;

use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateBotResponse implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userMessage;

    public function __construct(Message $message)
    {
        $this->userMessage = $message;
    }

    public function handle()
    {
        sleep(1); // эмуляция задержки

        $responseText = "Заглушка: ваш запрос — «{$this->userMessage->message_text}» — принят!";

        $botMessage = Message::create([
            'id_chat' => $this->userMessage->id_chat,
            'id_user' => 0, // 0 — бот
            'message_text' => $responseText,
            'message_type' => 'ai',
            'timestamp' => now(),
        ]);

        broadcast(new MessageSent($botMessage))->toOthers();
    }
}
