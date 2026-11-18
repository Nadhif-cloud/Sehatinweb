<?php

namespace Database\Factories;

use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Program>
 */
class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->randomElement([
                'Program Olahraga',
                'Rekomendasi Menu Sehat',
                'Kalkulator BMI',
                'Agenda Harian',
            ]),
            'deskripsi' => fake()->sentence(),
        ];
    }
}
