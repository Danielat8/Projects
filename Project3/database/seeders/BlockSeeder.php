<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Block;

class BlockSeeder extends Seeder
{
    public function run()
    {
        $user2 = User::find(2);
        $user3 = User::find(3);

        if ($user2 && $user3) {
            Block::create([
                'user_id' => $user2->id,
                'blocked_user_id' => $user3->id,
            ]);
        }
    }
}
