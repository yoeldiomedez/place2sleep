<?php

namespace Database\Factories;

use App\Models\Pavilion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mausoleum>
 */
class MausoleumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $number = fake()->numberBetween($min = 2, $max = 10);
        
        return [
            'pavilion_id'   => Pavilion::where('type', 'M')->whereIn('cemetery_id', [1, 2])->inRandomOrder()->first()->id,
            'name'          => fake()->company.' '.fake()->companySuffix,
            'location'      => fake()->bothify('Mz. ? Lote ##'),
            'doc'           => fake()->numerify('Resolucion N° ###-'.date('Y').'-SBPP-P'),
            'size'          => $number,
            'availability'  => $number,
            'extensions'    => 0,
            'price'         => fake()->randomFloat($nbMaxDecimals = 2, $min = 1000, $max = 99999)
        ];
    }
}
