<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    public function definition(): array //TODO: переделать сущность и атрибуты
    {
        return [
            'type' => 'system',
            'notifiable_type' => 'App\Models\User',
            'notifiable_id' => 1, // TODO: или rand/фейкер
            'timestamp' => now(),
            'read_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
