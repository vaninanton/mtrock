<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->company();
        $slug = Str::lower(Str::slug($title, '-'));

        return [
            'title' => $title,
            'slug' => $slug,
            'short_text' => fake()->sentence(),
            'full_text' => fake()->sentence(),
            'image' => null,
            'link' => null,
            'video' => null,
            'product_id' => null,
        ];
    }
}
