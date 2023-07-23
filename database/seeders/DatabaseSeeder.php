<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ru_RU.utf8');

        // Create the Testoviy User
        $user = User::create([
            'name' => 'test',
            'email' => 'test@test.test',
            'password' => bcrypt('qwerty0'),

        ]);

        foreach (range(1, 20) as $index) {
            Task::create([
                'title' => $faker->sentence(3),
                'description' => $faker->paragraph(5),
                'status' => $faker->randomElement(['pending', 'in_progress', 'resolved']),
                'deadline' => $faker->dateTimeBetween('now', '+3 day'),
                'user_id' => $user->id,
            ]);
        }
    }

}
