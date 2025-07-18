<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SectionQuestion>
 */
class SectionQuestionFactory extends Factory
{
    public function definition(): array
    {

        $section = \App\Models\SpecificationSection::factory()->create();

        return [
            'id_question' => $this->faker->unique()->numberBetween(1, 99999),
            'id_section' => $section->id_section,
            'question' => $this->faker->sentence(6),
            'position' => $this->faker->numberBetween(1, 20),
        ];
    }
}
