<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Param;
use App\Models\ParamsOption;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParamsProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `params_product` (
            `product_id`,
            `param_id`,
            `value`
        )
        SELECT
            `product_id`,
            `attribute_id`,
            `number_value`
        FROM `mtrock`.`mr_store_product_attribute_value`
        WHERE
            `number_value` IS NOT NULL AND
            `product_id` IN (SELECT id FROM products)
        ');
        DB::insert('INSERT INTO `params_product` (
            `product_id`,
            `param_id`,
            `value`
        )
        SELECT
            `product_id`,
            `attribute_id`,
            `string_value`
        FROM `mtrock`.`mr_store_product_attribute_value`
        WHERE
            `string_value` IS NOT NULL AND
            `product_id` IN (SELECT id FROM products)
        ');
        DB::insert('INSERT INTO `params_product` (
            `product_id`,
            `param_id`,
            `params_option_id`
        )
        SELECT
            `product_id`,
            `attribute_id`,
            `option_value`
        FROM `mtrock`.`mr_store_product_attribute_value`
        WHERE
            `option_value` IS NOT NULL AND
            `product_id` IN (SELECT id FROM products)
        ');

        $this->setCategoryByOption('Палатки', 'Область применения', 'Кемпинг', 'Кемпинговые палатки');
        $this->setCategoryByOption('Палатки', 'Область применения', 'Трекинг', 'Трекинговые палатки');
        $this->setCategoryByOption('Палатки', 'Область применения', 'Экстрим', 'Экстремальные палатки');
        $this->setCategoryByOption('Палатки', 'Область применения', 'Для рыбалки', 'Палатки для рыбалки');
        $this->setCategoryByOption('Спальные мешки', 'Тип спального мешка', 'Одеяло', 'Одеяло');
        $this->setCategoryByOption('Спальные мешки', 'Тип спального мешка', 'Кокон', 'Кокон');
        $this->setCategoryByOption('Рюкзаки', 'Тип рюкзака', 'Городской', 'Городские рюкзаки');
        $this->setCategoryByOption('Рюкзаки', 'Тип рюкзака', 'Туристический', 'Туристические рюкзаки');
        $this->setCategoryByOption('Рюкзаки', 'Тип рюкзака', 'Велосипедный', 'Велосипедные рюкзаки');
        $this->setCategoryByOption('Рюкзаки', 'Тип рюкзака', 'Велосипедный', 'Велосипедные рюкзаки');
    }

    private function setCategoryByOption(string $whereCategory, string $attributeTitle, string $attributeValue, string $categoryTitle): void
    {
        Product::query()
            ->where('category_id', '=', $this->getCategory($whereCategory))
            ->whereHas(
                'params',
                fn (Builder $query) => $query
                    ->where('params_product.param_id', '=', $this->getParam($attributeTitle))
                    ->where('params_product.params_option_id', '=', $this->getParamsOption($attributeValue))
            )
            ->update(['category_id' => $this->getCategory($categoryTitle)]);
    }

    private function getParam(string $title): int
    {
        return Param::where('title', '=', $title)->first()->id;
    }

    private function getParamsOption(string $title): int
    {
        return ParamsOption::where('value', '=', $title)->first()->id;
    }

    private function getCategory(string $title): int
    {
        return Category::where('title', '=', $title)->first()->id;
    }
}
