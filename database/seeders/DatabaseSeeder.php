<?php

namespace Database\Seeders;

use App\Models\Goal;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Course;
use App\Models\Requeriment;
use Illuminate\Database\Seeder;
use Database\Factories\GoalFactory;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Storage::deleteDirectory('courses');
        Storage::makeDirectory('courses/images');

        User::factory()->create([
            'name' => 'Robert Rivera Castañeda',
            'email' => 'rxrc1819@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $this->call([
            CategorySeeder::class,
            LevelSeeder::class,
            PriceSeeder::class,
            CourseSeeder::class

        ]);
      
    }
}
