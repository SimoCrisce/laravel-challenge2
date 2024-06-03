<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Activity::factory(10)->create();
        $activities = ['Mountain Bike', 'Calcio', 'Basket', 'Pallavolo', 'Nuoto', 'Tennis'];
        foreach($activities as $activity) {
            Activity::create([
                'name' => $activity,
                'description' => fake()->words(rand(15, 20), true),
            ]);
        }
    }
}
