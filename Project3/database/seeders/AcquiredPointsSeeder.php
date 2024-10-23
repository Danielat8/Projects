<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AcquiredPoint;
use App\Models\User;
use Faker\Factory as Faker;

class AcquiredPointsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::pluck('id')->toArray();

        for ($i = 1; $i < 5; $i++) {
            AcquiredPoint::create([
                'user_id' => $faker->randomElement($users),
                'points' => $faker->numberBetween(10, 1000),
            ]);
        }
    }
}
