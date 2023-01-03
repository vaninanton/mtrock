<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT IGNORE INTO `product_attribute` (
            `product_id`,
            `attribute_id`,
            `value`
        )
        SELECT
            `product_id`,
            `attribute_id`,
            `number_value`
        FROM `mtrock`.`mr_store_product_attribute_value`
        WHERE `number_value`
        ');
        DB::insert('INSERT IGNORE INTO `product_attribute` (
            `product_id`,
            `attribute_id`,
            `value`
        )
        SELECT
            `product_id`,
            `attribute_id`,
            `string_value`
        FROM `mtrock`.`mr_store_product_attribute_value`
        WHERE `string_value`
        ');
        DB::insert('INSERT IGNORE INTO `product_attribute` (
            `product_id`,
            `attribute_id`,
            `attribute_option_id`
        )
        SELECT
            `product_id`,
            `attribute_id`,
            `option_value`
        FROM `mtrock`.`mr_store_product_attribute_value`
        WHERE `option_value`
        ');

        $this->setCategoryByOption('Палатки', 'Область применения', 'Кемпинг', 'Кемпинговые палатки');
        $this->setCategoryByOption('Палатки', 'Область применения', 'Трекинг', 'Трекинговые палатки');
        $this->setCategoryByOption('Палатки', 'Область применения', 'Экстрим', 'Экстремальные палатки');
        $this->setCategoryByOption('Палатки', 'Область применения', 'Для рыбалки', 'Палатки для рыбалки');
    }

    private function setCategoryByOption(string $whereCategory, string $attributeTitle, string $attributeValue, string $categoryTitle): void
    {
        Product::query()
            ->where('category_id', '=', $this->getCategory('Палатки'))
            ->whereHas(
                'attributes',
                fn (Builder $query) => $query
                    ->where('product_attribute.attribute_id', '=', $this->getAttribute($attributeTitle))
                    ->where('product_attribute.attribute_option_id', '=', $this->getAttributeOption($attributeValue))
            )
            ->update(['category_id' => $this->getCategory($categoryTitle)]);
    }

    private function getAttribute(string $title): int
    {
        return Attribute::where('title', '=', $title)->first()->id;
    }

    private function getAttributeOption(string $title): int
    {
        return AttributeOption::where('value', '=', $title)->first()->id;
    }

    private function getCategory(string $title): int
    {
        return Category::where('title', '=', $title)->first()->id;
    }
}
