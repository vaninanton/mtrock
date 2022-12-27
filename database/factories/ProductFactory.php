<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->words(3, true);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'sku' => fake()->word,
            'category_id' => fake()->randomElement([1, 2, 3, 4]),
            'brand_id' => fake()->randomElement([1, 2, 3, 4]),
            'type_id' => fake()->randomElement([1, 2, 3, 4]),
            'quantity' => fake()->randomDigit(),
            'price' => fake()->randomFloat(2, 1000, 10000),
            'old_price' => fake()->randomFloat(2, 1000, 10000),
            'type_prefix' => fake()->word,
            'model' => fake()->word,
            'short_description' => fake()->paragraph,
            'description' => fake()->paragraphs(3, true),
            'flag_new' => fake()->boolean(50),
            'flag_hit' => fake()->boolean(50),
        ];
    }
}
