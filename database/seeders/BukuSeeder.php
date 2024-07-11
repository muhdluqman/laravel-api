<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('ms_MY');

        // Use a positive number for the loop
        for ($i = 0; $i < 10; $i++) {
            Buku::create([
                'tajuk' => $faker->sentence,
                'penulis' => $faker->name,
                'tarikh_dikeluarkan' => $faker->date
            ]);
        }
    }
}
