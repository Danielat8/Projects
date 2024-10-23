<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\File;


class UserAboutSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $directory = public_path('uploads/photos');


        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }


        if (!DB::table('user_abouts')->where('user_id', 1)->exists()) {
            DB::table('user_abouts')->insert([
                'user_id' => 1,
                'surname' => 'Admin',
                'bio' => 'This is the admin user.',
                'title' => 'Administrator',
                'phone' => '1234567890',
                'city' => 'Admin City',
                'country' => 'Admin Country',
                'cv_upload' => 'uploads/cvs/' . $faker->word . '.pdf',
                'photo_upload' => 'uploads/photos/' . $faker->image('public/uploads/photos', 640, 480, 'people', false),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        for ($i = 2; $i <= 4; $i++) {
            DB::table('user_abouts')->insert([
                'user_id' => $i,
                'surname' => $faker->lastName,
                'bio' => $faker->sentence,
                'title' => $faker->jobTitle,
                'phone' => $faker->phoneNumber,
                'city' => $faker->city,
                'country' => $faker->country,
                'cv_upload' => 'uploads/cvs/' . $faker->word . '.pdf',
                'photo_upload' => 'uploads/photos/' . $faker->image('public/uploads/photos', 640, 480, 'people', false),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
