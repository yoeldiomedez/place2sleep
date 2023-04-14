<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Relative>
 */
class RelativeFactory extends Factory
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
            'document_type'     => fake()->randomElement(['DNI', 'RUC', 'P. NAC.', 'CARNET EXT.', 'PASAPORTE', 'OTRO']),
            'document_numb'     => fake()->unique()->randomNumber(8),
            'cellphone_numb'    => fake()->unique()->randomNumber(9),
            'address'           => fake()->address
        ];
    }
}
