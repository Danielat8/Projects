<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Connection;
use App\Models\User;
use Faker\Factory as Faker;

class ConnectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();


        $users = User::pluck('id')->toArray();

        for ($i = 0; $i < 4; $i++) {
            Connection::create([
                'user_id' => $faker->randomElement($users),
                'friend_user_id' => $faker->randomElement($users),
                'connected_at' => $faker->dateTimeThisYear(),
            ]);
        }
    }
}
