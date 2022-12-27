<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->company();

        return [
            'slug' => Str::slug($title),
            'title' => $title,
            'image' => 'https://picsum.photos/800/600?random='.rand(10000, 19999),
            'short_description' => null,
            'description' => null,
            'position' => 0,
        ];
    }
}
