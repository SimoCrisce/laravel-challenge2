<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => ['Mountain Bike', 'Calcio', 'Basket', 'Pallavolo', 'Nuoto', 'Tennis'],
            'description' => fake()->words(rand(15, 20), true),
        ];
    }
}
