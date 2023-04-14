<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deceased>
 */
class DeceasedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'names'             => fake()->name,
            'surnames'          => fake()->lastName,
            'gender'            => fake()->randomElement(['M', 'F']),
            'marital_status'    => fake()->randomElement(['S', 'C', 'V', 'D']),
            'document_type'     => fake()->randomElement(['DNI', 'RUC', 'P. NAC.', 'CARNET EXT.', 'PASAPORTE', 'OTRO']),
            'document_numb'     => fake()->unique()->randomNumber(8),
            'birth_date'        => fake()->date,
            'death_date'        => fake()->date,
            'country_origin'    => fake()->country
        ];
    }
}
