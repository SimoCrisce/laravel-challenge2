<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Simone',
            'email' => 'simo@simo.it',
            'password' => bcrypt('simo'),
        ]);
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.it',
            'role' => 'admin',
            'password' => bcrypt('admin'),
        ]);
        User::factory(10)->create();

        $users = User::all()->all();
        $course_ids = Course::all()->pluck('id')->all();
        
        foreach ($users as $user) {
            $courses_for_user = fake()->randomElements($course_ids, rand(1, count($course_ids)));
            foreach ($courses_for_user as $course_id) {
                $user->courses()->attach($course_id, ['status' => 'pending']);
            }
        }
    }

}
