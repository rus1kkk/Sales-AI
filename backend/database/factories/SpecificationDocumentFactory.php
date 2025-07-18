<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpecificationDocument>
 */
class SpecificationDocumentFactory extends Factory
{
    public function definition(): array
    {

        $chat = \App\Models\Chat::factory()->create();

        return [
            'id_document' => $this->faker->unique()->numberBetween(1, 999999),
            'id_chat' => $chat->id_chat,
            'version' => 'v1.0',
            'created_at' => now(),
        ];
    }
}
