<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UnbanUsers extends Command
{
    protected $signature = 'users:unban';
    protected $description = 'Unban users whose ban 3 days ago and more';

    public function handle()
    {

        $threeDaysAgo = Carbon::now()->subDays(3);


        $users = User::where('is_banned', true)
            ->where('ban_end_date', '<=', $threeDaysAgo)
            ->get();

        foreach ($users as $user) {
            $user->is_banned = false;
            $user->ban_end_date = null;
            $user->save();
            $this->info("User {$user->id} has been unbanned.");
        }
    }
}
