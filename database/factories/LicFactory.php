<?php

namespace Database\Factories;

use App\Models\Lic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lic>
 */
class LicFactory extends Factory
{   
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nu_fase' => fake()->numberBetween(-1,1),
            'nu_edital' => fake()->sentence,
            'modalidade' => fake()->sentence,
            'data_abertura' => fake()->date(),
            'nome_licitador' => fake()->sentence,
            'cnpj_licitador' => fake()->numberBetween(10000000000,99999999999),
            'prioridade' => fake()->numberBetween(0,5),
            'objeto' => fake()->sentence,
        ];
    }
}
