<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use App\Models\Blog;

class LikeSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = User::where('id', '>', 1)->get();
        $comments = Comment::all();
        $blogs = Blog::all();


        if ($users->isEmpty() || $comments->isEmpty() || $blogs->isEmpty()) {
            $this->command->warn('Skipping LikeSeeder because one of the collections is empty.');
            return;
        }

        $faker = \Faker\Factory::create();


        for ($i = 1; $i < 100; $i++) {
            Like::create([
                'user_id' => $users->random()->id,
                'comment_id' => $comments->random()->id,
                'blog_id' => $blogs->random()->id,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
