<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpecificationSection>
 */
class SpecificationSectionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_section' => $this->faker->unique()->numberBetween(1, 99999),
            'title' => $this->faker->sentence(3),
        ];
    }
}
