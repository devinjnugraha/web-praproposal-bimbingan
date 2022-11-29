<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Dosen::factory()->create([
            'nama' => 'Devin Jaya Nugraha',
            'nip' => '205150200111055',
            'kuota' => '30',
        ]);

        \App\Models\Bimbingan::factory(30)->create();
    }
}
