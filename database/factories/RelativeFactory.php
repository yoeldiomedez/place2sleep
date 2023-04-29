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
        $name = fake()->boolean() ? fake()->firstNameMale() : fake()->firstNameFemale() ;

        $doc_type = fake()->randomElement(['DNI', 'RUC', 'P. NAC.', 'CARNET EXT.', 'PASAPORTE', 'OTRO']);
        $doc_numb = null;

        switch ($doc_type) {
            case 'DNI':
                $doc_numb = fake()->dni();
                break;

            case 'RUC':
                $doc_numb = fake()->ruc(fake()->boolean());
                break;

            default:
                $doc_numb = fake()->unique()->randomNumber(9);
                break;
        }

        return [
            'names'             => $name,
            'surnames'          => fake()->lastName(),
            'document_type'     => $doc_type,
            'document_numb'     => $doc_numb,
            'cellphone_numb'    => fake()->unique()->randomNumber(9),
            'address'           => fake()->address(),
        ];
    }
}
