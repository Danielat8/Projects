<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Badge;
use App\Models\User;
use Faker\Factory as Faker;

class BadgesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            Badge::create([
                'user_id' => $faker->randomElement($users),
                'title' => $faker->word,
                'description' => $faker->sentence,
                'acquired_at' => $faker->dateTimeThisYear(),
            ]);
        }
    }
}
