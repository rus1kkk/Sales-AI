<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chat>
 */
class ChatFactory extends Factory
{

    public function definition(): array
    {

        $model = \App\Models\AI_model::factory()->create();

        return [
            'id_chat' => $this->faker->unique()->numberBetween(1, 99999),
            'model_name' => $model->model_name,
            'chat_name' => $this->faker->words(2, true),
            'chat_status' => $this->faker->randomElement(['active', 'inactive']),
            'timestamp' => now(),
        ];
    }
}
