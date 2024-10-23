<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recommendation;
use App\Models\User;
use Faker\Factory as Faker;


class RecommendationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::where('id', '>', 1)->pluck('id')->toArray();

        for ($i = 1; $i < 5; $i++) {
            Recommendation::create([
                'from_user_id' => $faker->randomElement($users),
                'description' => $faker->sentence,
                'for_user_id' => $faker->randomElement($users),

            ]);
        }
    }
}
