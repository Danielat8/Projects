<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EventSpeakersSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $isEvent = $faker->boolean;

        for ($i = 1; $i <= 5; $i++) {
            DB::table('event_speakers')->insert([
                'event_id' => $isEvent ? $faker->numberBetween(1, 5) : null,
                'conference_id' => !$isEvent ? $faker->numberBetween(1, 5) : null,
                'name' => $faker->name,
                'title' => $faker->jobTitle,
                'type' => $faker->randomElement(['speaker', 'special_guest']),
                'image' => $faker->imageUrl(640, 480, 'people'),
                'linkedin' => $faker->url,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
