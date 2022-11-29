<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Dosen;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bimbingan>
 */
class BimbinganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'nim' => $this->faker->unique()->nik(),
            'topik_skripsi' => $this->faker->sentence(),
            'dosen_id' => Dosen::all()->first()->id,
        ];
    }
}
