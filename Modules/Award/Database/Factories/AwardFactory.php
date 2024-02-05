<?php

namespace Modules\Award\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AwardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Award\App\Models\Award::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'coefficient' => rand(1,10),
            'inventory' => rand(1,10),
        ];
    }
}

