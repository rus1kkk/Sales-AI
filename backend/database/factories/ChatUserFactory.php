<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChatUser>
 */
class ChatUserFactory extends Factory
{
    public function definition(): array
    {

        $chat = \App\Models\Chat::factory()->create();
        $user = \App\Models\User::factory()->create();

        return [
            'id_chat' => $chat->id_chat,
            'id_user' => $user->id_user,
            'timestamp' => now(),
        ];
    }
}
