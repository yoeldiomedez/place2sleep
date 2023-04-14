<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exhumations>
 */
class ExhumationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'deceased_id'   => fake()->numberBetween($min = 1, $max = 50),
            'reference_doc' => fake()->numerify('Resolucion N° ###-'.date('Y').'-SBPP-P'),
            'notes'         => fake()->text($maxNbChars = 500),
        ];
    }
}
