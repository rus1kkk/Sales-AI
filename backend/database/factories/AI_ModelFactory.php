<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AI_model>
 */
class AI_ModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_model' => $this->faker->unique()->numberBetween(1, 99999),
            'model_name' => $this->faker->unique()->word(),
            'model_fullname' => $this->faker->words(3, true),
            'model_info' => $this->faker->paragraph(),
        ];
    }
}
