<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class EmployeesSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();


        for ($i = 1; $i < 5; $i++) {
            DB::table('employees')->insert([
                'job' => $faker->jobTitle,
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'bio' => $faker->paragraph,
                'picture_path' => $faker->imageUrl(640, 480, 'business'),
                'facebook' => $faker->url,
                'twitter' => $faker->url,
                'instagram' => $faker->url,
                'linkedin' => $faker->url,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
