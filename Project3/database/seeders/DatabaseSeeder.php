<?php

namespace Database\Seeders;

use App\Models\GeneralInfo;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // php artisan migrate:fresh --seed
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            AnnualConferencesSeeder::class,
            BlogsSeeder::class,
            LikeSeeder::class,
            CommentsSeeder::class,
            EventsSeeder::class,
            TicketsSeeder::class,
            EventSpeakersSeeder::class,
            AgendasSeeder::class,
            UserActivityLogSeeder::class,
            EmployeesSeeder::class,
            UserAboutSeeder::class,
            DescriptionSeeder::class,
            ConnectionsSeeder::class,
            BadgesSeeder::class,
            AcquiredPointsSeeder::class,
            BoughtTicketsSeeder::class,
            RecommendationsSeeder::class,
            GeneralInfoSeeder::class,
            BlockSeeder::class,
        ]);
    }
}
