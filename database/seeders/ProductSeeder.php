<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->create([
            'title' => 'Палатка Alexika Mirage 4 красный',
            'slug' => 'palatka-alexika-mirage-4-krasnyy',
            'sku' => '9101.4103',
            'price' => 83039,
            'old_price' => 103799,
            'category_id' => 1,
            'short_description' => 'Предназначена для организации высокогорных базовых лагерей.',
        ]);
        Product::factory(10)->create();
    }
}
