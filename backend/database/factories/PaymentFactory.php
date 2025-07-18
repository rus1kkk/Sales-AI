<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    public function definition(): array
    {

        $user = \App\Models\User::factory()->create();

        return [
            'id_payment' => $this->faker->unique()->numberBetween(1, 99999),
            'id_user' => $user->id_user,
            'amount' => $this->faker->numberBetween(100, 1000),
            'type' => $this->faker->randomElement(['card', 'bank_transfer', 'crypto']),
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
            'timestamp' => now(),
        ];
    }
}
