<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EventsSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 5; $i++) {
            DB::table('events')->insert([
                'title' => $faker->sentence(4),
                'theme' => $faker->word,
                'description' => $faker->paragraph,
                'objective' => $faker->sentence(6),
                'date' => $faker->date(),
                'location' => $faker->city,
                'picture_path' => $faker->imageUrl(640, 480, 'business'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
