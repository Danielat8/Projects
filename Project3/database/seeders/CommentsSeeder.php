<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CommentsSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) {
            $commentId = DB::table('comments')->insertGetId([
                'blog_id' => $faker->numberBetween(1, 5),
                'user_id' => $faker->numberBetween(2, 3),
                'body' => $faker->paragraph,
                'reply_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            for ($j = 1; $j < $faker->numberBetween(0, 3); $j++) {
                DB::table('comments')->insert([
                    'blog_id' => $faker->numberBetween(1, 5),
                    'user_id' => $faker->numberBetween(2, 3),
                    'body' => $faker->paragraph,
                    'reply_id' => $commentId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
