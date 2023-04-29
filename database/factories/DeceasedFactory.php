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
        $gender = fake()->randomElement(['M', 'F']);
        $name   = ($gender == 'M') ? fake()->firstNameMale() : fake()->firstNameFemale() ;

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
            'gender'            => $gender,
            'marital_status'    => fake()->randomElement(['S', 'C', 'V', 'D']),
            'document_type'     => $doc_type,
            'document_numb'     => $doc_numb,
            'birth_date'        => fake()->date(),
            'death_date'        => fake()->date(),
            'country_origin'    => fake()->country(),
        ];
    }
}
