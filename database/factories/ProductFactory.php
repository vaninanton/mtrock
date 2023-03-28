<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
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
    public function definition(): array
    {
        $title = fake()->words(3, true);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'sku' => fake()->word,
            'category_id' => fake()->randomElement(Category::query()->pluck('id')),
            'brand_id' => fake()->randomElement(Brand::query()->pluck('id')),
            'type_id' => fake()->randomElement(Type::query()->pluck('id')),
            'quantity' => fake()->randomDigit(),
            'price' => fake()->randomFloat(2, 1000, 10000),
            'old_price' => fake()->randomFloat(2, 1000, 10000),
            'type_prefix' => fake()->word,
            'model' => fake()->word,
            'short_description' => fake()->sentence,
            'description' => fake()->paragraphs(3, true),
            'flag_new' => fake()->boolean(50),
            'flag_hit' => fake()->boolean(50),
        ];
    }
}
