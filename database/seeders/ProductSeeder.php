<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `products` (
            `id`,
            `title`,
            `slug`,
            `sku`,
            `category_id`,
            `brand_id`,
            `type_id`,
            `quantity`,
            `in_stock`,
            `price`,
            `old_price`,
            `type_prefix`,
            `model`,
            `image`,
            `short_description`,
            `description`,
            `flag_new`,
            `flag_hit`,
            `length`,
            `width`,
            `height`,
            `weight`,
            `created_at`,
            `updated_at`
        )
        SELECT
            `id`,
            `name`,
            `slug`,
            `sku`,
            NULL, -- `category_id`,
            `producer_id`,
            `type_id`,
            IFNULL(`quantity`, 0),
            IFNULL(`in_stock`, 0),
            `price`,
            `old_price`,
            `type_prefix`,
            `model`,
            `image`,
            `short_description`,
            `description`,
            IFNULL(`is_new`, 0),
            IFNULL(`is_hit`, 0),
            `length`,
            `width`,
            `height`,
            `weight`,
            `create_time`,
            `update_time`
        FROM `mtrock`.`mr_store_product`
        WHERE `status` = 1 AND category_id != 1015');

        $categories = [
            'Палатки' => ['Палатка'],
            'Спальные мешки' => ['Спальник'],
            'Рюкзаки' => ['Рюкзак'],
            'Горелки и газовое оборудование' => ['Горелка'],
            'Походная посуда' => ['Туристическая посуда', 'Термос', 'Фильтр для воды'],
            'Туристические коврики и подушки' => ['Самонадувающийся коврик', 'Коврик туристический'],
            'Кемпинговая мебель' => ['Кемпинговая мебель'],
            'Аксессуары' => ['Аксессуары', 'Мультитул', 'Гамаши', 'Аптечка туристическая'],
            'Гермомешки, гермобаулы' => ['Гермомешок'],
            'Тенты' => ['Каркасный тент', 'Туристический тент'],
            'Треккинговые палки' => ['Треккинговые палки', 'Палки для скандинавской ходьбы'],
            'Самокаты' => ['Самокаты'],
            'Снегоступы' => ['Снегоступы'],
            'Дорожные, вело и поясные сумки' => ['Сумка дорожная', 'Мешок компрессионный', 'Сумка'],
            'Лонгборды и круизёры' => ['Лонгборд'],
            'Фонари и источники питания' => ['Фонарь', 'Power Bank'],
            'Лавинное снаряжение' => ['Лавинное снаряжение'],
            'Альпинизм' => ['Альпинистские кошки'],
        ];

        foreach ($categories as $category => $types) {
            $category_id = Category::whereTitle($category)->first()->id;
            Product::whereBelongsTo(Type::whereIn('title', $types)->get())->update(['category_id' => $category_id]);
        }
        Product::whereBelongsTo(Brand::where('title', 'Kovea')->get())->update(['category_id' => 4]);
    }
}
