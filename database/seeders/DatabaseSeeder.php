<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Award\Database\Seeders\AwardDatabaseSeeder;
use Modules\User\App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();
        $this->call([
            AwardDatabaseSeeder::class,
        ]);
    }
}
