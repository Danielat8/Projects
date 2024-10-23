<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AgendasSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $userId = 1;
        $isEvent = $faker->boolean;
        if ($userId === 1) {
            for ($i = 1; $i <= 10; $i++) {
                DB::table('agendas')->insert([
                    'event_id' => $isEvent ? $faker->numberBetween(1, 5) : null,
                    'conference_id' => !$isEvent ? $faker->numberBetween(1, 5) : null,
                    'title' => $faker->sentence(3),
                    'description' => $faker->paragraph,
                    'time' => $faker->time('H:i'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
