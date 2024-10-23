<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Description;
use App\Models\Agenda;
use Faker\Factory as Faker;

class DescriptionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $userId = 1;

        $agendas = Agenda::all();


        foreach ($agendas as $agenda) {

            if ($userId === 1) {
                for ($i = 1; $i < 3; $i++) {
                    Description::create([
                        'agenda_id' => $agenda->id,
                        'description' => $faker->paragraph(3, true),
                    ]);
                }
            }
        }
    }
}
