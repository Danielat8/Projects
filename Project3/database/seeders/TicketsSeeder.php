<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TicketsSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $isEvent = $faker->boolean;

        for ($i = 1; $i <= 10; $i++) {
            DB::table('tickets')->insert([
                'event_id' => $isEvent ? $faker->numberBetween(1, 5) : null,
                'conference_id' => !$isEvent ? $faker->numberBetween(1, 5) : null,
                'ticket_type' => $faker->randomElement(['General Admission', 'VIP', 'Early Bird']),
                'price' => $faker->randomFloat(2, 10, 200),
                'quantity' => $faker->numberBetween(2, 100),
                'available' => $faker->numberBetween(2, 100),
                'ticket_name' => $faker->word,
                'ticket_date' => $faker->dateTimeThisYear(),
                'place' => $faker->address,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
