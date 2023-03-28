<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->company();
        $slug = Str::lower(Str::slug($title, '-'));

        return [
            'title' => $title,
            'slug' => $slug,
            'body' => fake()->sentence(),
            'meta_description' => fake()->sentence(),
            'deleted_at' => null,
        ];
    }

    /**
     * @return static
     */
    public function deleted()
    {
        return $this->state(fn (array $attributes) => [
            'deleted_at' => now(),
        ]);
    }
}
