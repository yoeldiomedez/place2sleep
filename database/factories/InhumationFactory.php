<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inhumation>
 */
class InhumationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $buriable = $this->buriable();

        return [
            'buriable_id'   => $buriable::factory(),
            'buriable_type' => $buriable,
            'deceased_id'   => \App\Models\Deceased::factory(),
            'relative_id'   => \App\Models\Relative::factory(),
            'ric'           => fake()->numerify('Comprobante N° ###-'.date('Y').'-SBPP-P'),
            'agreement'     => fake()->randomElement(['C', 'R', 'I', 'E']),
            'amount'        => fake()->randomFloat($nbMaxDecimals = 2, $min = 1000, $max = 99999),
        ];
    }

    public function buriable()
    {
        return fake()->randomElement([
            \App\Models\Niche::class,
            \App\Models\Mausoleum::class,
        ]);
    }
}
