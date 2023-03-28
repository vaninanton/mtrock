<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->company();
        $slug = Str::slug($title, '-');

        return [
            'parent_id' => null,
            'slug' => $slug,
            'title' => $title,
            'image' => null,
            'short_description' => null,
            'description' => null,
            'meta_title' => null,
            'meta_description' => null,
            'position' => null,
        ];
    }
}
