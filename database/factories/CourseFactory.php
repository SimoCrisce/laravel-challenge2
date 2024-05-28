<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $activity_ids = Activity::all()->pluck('id')->all();
        $slot_ids = Activity::all()->pluck('id')->all();
        return [
            'activity_id' => fake()->randomElement($activity_ids),
            'slot_id' => fake()->randomElement($slot_ids),
            'location' => fake()->address(),
        ];
    }
}
