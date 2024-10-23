<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserActivityLogSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 5; $i++) {
            DB::table('user_activity_log')->insert([
                'job' => $faker->jobTitle,
                'user_id' => $faker->numberBetween(2, 3),
                'notification_target_preference' => $faker->word . ', ' . $faker->word,
                'notification_topic_preference' => $faker->word . ', ' . $faker->word,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
