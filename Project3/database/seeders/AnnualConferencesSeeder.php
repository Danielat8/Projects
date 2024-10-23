<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AnnualConferencesSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 5; $i++) {
            DB::table('annual_conferences')->insert([
                'title' => $faker->sentence(3),
                'theme' => $faker->word,
                'description' => $faker->paragraph,
                'date' => $faker->date(),
                'location' => $faker->city,
                'objective' => $faker->sentence(6),
                'agenda' => $faker->paragraph,
                'status' => $faker->randomElement(['upcoming', 'completed', 'canceled']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
