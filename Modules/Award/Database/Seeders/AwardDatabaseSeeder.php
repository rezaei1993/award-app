<?php

namespace Modules\Award\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Award\App\Models\Award;

class AwardDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Award::firstOrCreate(
            [
                'title' => 'Empty'
            ],
            [
                'coefficient' => 1,
                'inventory' => 0,
            ]
        );

        for ($i = 1; $i <= 10; $i++) {
            Award::firstOrCreate(
                [
                    'title' => 'Prize ' . $i
                ],
                [
                    'coefficient' => rand(1, 5),
                    'inventory' => rand(10, 50),
                ]
            );
        }
    }
}
