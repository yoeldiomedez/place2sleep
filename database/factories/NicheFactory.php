<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Niche>
 */
class NicheFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pavilion_id' => \App\Models\Pavilion::factory(),
            'row_x'       => strtoupper(fake()->randomLetter()),
            'col_y'       => fake()->numberBetween($min = 1, $max = 99),
            'category'    => fake()->randomElement(['A', 'P', 'O', 'D', 'Z']),
            'state'       => 'D',
            'price'       => fake()->randomFloat($nbMaxDecimals = 2, $min = 1000, $max = 99999)
        ];
    }
}
