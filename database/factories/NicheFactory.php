<?php

namespace Database\Factories;

use App\Models\Pavilion;
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
            'pavilion_id' => Pavilion::where('type', 'N')->whereIn('cemetery_id', [1, 2])->inRandomOrder()->first()->id,
            'row_x'       => strtoupper(fake()->randomLetter),
            'col_y'       => fake()->numberBetween($min = 1, $max = 99),
            'category'    => fake()->randomElement(['A', 'P', 'O', 'D', 'Z']),
            'state'       => 'D',
            'price'       => fake()->randomFloat($nbMaxDecimals = 2, $min = 1000, $max = 99999)
        ];
    }
}
