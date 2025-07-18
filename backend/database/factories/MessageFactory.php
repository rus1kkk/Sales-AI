<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    public function definition(): array
    {

        $chat = \App\Models\Chat::factory()->create();
        $user = \App\Models\User::factory()->create();

        return [
            'id' => $this->faker->unique()->numberBetween(1, 999999),
            'id_chat' => $chat->id_chat,
            'id_user' => $user->id_user,
            'message_text' => $this->faker->paragraph(),
            'message_type' => $this->faker->randomElement(['user', 'bot']),
            'timestamp' => now(),
        ];
    }
}
