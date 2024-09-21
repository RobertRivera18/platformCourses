<?php

namespace Database\Factories;

use App\Models\Level;
use App\Models\Price;
use App\Models\Category;
use Illuminate\Support\Str;
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
        $title = $this->faker->sentence();
        return [
            'title' =>$title,
            'slug'=>Str::slug($title),
            'slug' => $this->faker->slug,
            'status' => 3,
            'image_path' =>'courses/images/'. $this->faker->image('public/storage/courses/images', 640, 480, null,false),
            'user_id' => 1,
            'level_id' => Level::all()->random()->id,
            'category_id' => Category::all()->random()->id,
            'price_id' => Price::all()->random()->id,

        ];
    }
}
