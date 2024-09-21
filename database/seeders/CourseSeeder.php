<?php

namespace Database\Seeders;

use App\Models\Goal;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\Requeriment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::factory(30)->create()->each(function ($course) {
            Goal::factory(6)->create([
                'course_id' => $course->id
            ]);

            Requeriment::factory(6)->create([
                'course_id' => $course->id
            ]);
            Section::factory(5)->create([
                'course_id' => $course->id
            ])->each(function ($section) {
                Lesson::factory(5)->create([
                    'section_id' => $section->id
                ]);
            });
        });
    }
}
