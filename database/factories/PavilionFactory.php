<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pavilion>
 */
class PavilionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cemetery_id' => fake()->randomElement([1, 2]),
            'type'        => fake()->randomElement(['N', 'M']),
            'name'        => fake()->bothify('Pabellon ###')
        ];
    }
}
