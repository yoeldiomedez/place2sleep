<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exhumations>
 */
class ExhumationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'inhumation_id' => \App\Models\Inhumation::factory(),
            'ric'           => fake()->numerify('Comprobante N° ###-'.date('Y').'-SBPP-P'),
            'doc'           => fake()->numerify('Resolucion N° ###-'.date('Y').'-SBPP-P'),
            'notes'         => fake()->text($maxNbChars = 500),
        ];
    }
}
