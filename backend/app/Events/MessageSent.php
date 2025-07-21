<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
        \Log::info('Broadcasting MessageSent for chat ID: ' . $message->id_chat);
    }

    public function broadcastOn()
    {
        return new Channel('chat.' . $this->message->id_chat);
    }

    public function broadcastWith()
    {
        return [
            'message' => [
                'id' => $this->message->id,
                'id_user' => $this->message->id_user,
                'id_chat' => $this->message->id_chat,
                'message_text' => $this->message->message_text,
                'created_at' => $this->message->created_at,
            ]
        ];
    }
}
