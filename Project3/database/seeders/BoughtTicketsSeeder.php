<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BoughtTicket;
use App\Models\User;
use Faker\Factory as Faker;
use App\Models\Ticket;

class BoughtTicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::where('id', '>', 1)->pluck('id')->toArray();
        $tickets = Ticket::pluck('id')->toArray();
        for ($i = 1; $i < 5; $i++) {
            BoughtTicket::create([
                'user_id' => $faker->randomElement($users),
                'ticket_id' => $faker->randomElement($tickets),

            ]);
        }
    }
}
