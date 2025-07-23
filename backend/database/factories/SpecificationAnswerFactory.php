<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpecificationAnswer>
 */
class SpecificationAnswerFactory extends Factory
{
    public function definition(): array
    {

        $document = \App\Models\SpecificationDocument::factory()->create();
        $question = \App\Models\SectionQuestion::factory()->create();

        return [
            'id_answer' => $this->faker->unique()->numberBetween(1, 999999),
            'id_section' => $document->id_section,
            'id_question' => $question->id_question,
            'answer' => $this->faker->paragraph(),
            'answer_formatted' => null,
            'created_at' => now(),
        ];
    }
}
