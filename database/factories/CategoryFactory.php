<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'parent_id' => null,
            'slug' => null,
            'name' => null,
            'image' => null,
            'short_description' => null,
            'description' => null,
            'meta_title' => null,
            'meta_description' => null,
            'position' => null,
        ];
    }
}
