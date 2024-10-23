<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GeneralInfo;
use Faker\Factory as Faker;

class GeneralInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();


        GeneralInfo::create([
            'general' => $faker->paragraph,
            'picture_path' => $faker->imageUrl(640, 480, 'business', true, 'Company Hero'),
            'facebook' => $faker->url,
            'twitter' => $faker->url,
            'instagram' => $faker->url,
            'linkedin' => $faker->url,
            'created_at' => now(),
        ]);
    }
}
