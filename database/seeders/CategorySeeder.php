<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'title' => 'Палатки',
                'subcategories' => [
                    'Кемпинговые палатки',
                    'Трекинговые палатки',
                    'Экстремальные палатки',
                    'Палатки для рыбалки',
                    // 'Легкие палатки',
                    // 'Быстросборные палатки',
                ],
            ],
            [
                'title' => 'Спальные мешки',
                'subcategories' => [
                    'Кокон',
                    'Одеяло',
                ],
            ],
            [
                'title' => 'Рюкзаки',
                'subcategories' => [
                    'Туристические рюкзаки',
                    'Городские рюкзаки',
                    'Велосипедные рюкзаки',
                    'Питьевые системы',
                    'Накидки',
                ],
            ],
            [
                'title' => 'Походная посуда',
                'subcategories' => [
                    'Наборы посуды',
                    'Котелки и чайники',
                    'Столовые приборы',
                    'Миски',
                    'Кружки',
                    'Термосы и фляги',
                    'Посуда',
                    'Аксессуары для походной кухни',
                ],
            ],
            [
                'title' => 'Горелки туристические',
                'subcategories' => [
                    'Газовые горелки',
                    'Системы приготовления',
                    'Спиртовые горелки',
                    'Мультитопливные горелки',
                    'Газовые лампы',
                    'Газовые плиты',
                    'Газовые обогреватели',
                    'Аксессуары для горелок',
                ],
            ],
            [
                'title' => 'Туристические коврики',
                'subcategories' => [
                    'Самонадувающиеся коврики',
                    'Надувные коврики',
                ],
            ],
            [
                'title' => 'Кемпинговая мебель',
                'subcategories' => [
                    'Стулья',
                    'Столы',
                    'Раскладушки',
                ],
            ],
            [
                'title' => 'Аксессуары',
                'subcategories' => [
                    'Аптечки',
                    'Разведение огня',
                    'Кошельки',
                    'Гамаши',
                ],
            ],
            [
                'title' => 'Гермомешки, гермобаулы',
                'subcategories' => [

                ],
            ],
            [
                'title' => 'Тенты',
                'subcategories' => [
                    'Каркасные тенты и шатры',
                    'Туристические тенты',
                ],
            ],
            [
                'title' => 'Треккинговые палки',
                'subcategories' => [

                ],
            ],
            [
                'title' => 'Самокаты',
                'subcategories' => [

                ],
            ],
            [
                'title' => 'Снегоступы',
                'subcategories' => [

                ],
            ],
            [
                'title' => 'Дорожные, вело и поясные сумки',
                'subcategories' => [

                ],
            ],
            [
                'title' => 'Лонгборды и круизёры',
                'subcategories' => [

                ],
            ],
            [
                'title' => 'Фонари и источники питания',
                'subcategories' => [

                ],
            ],
            [
                'title' => 'Лавинное снаряжение',
                'subcategories' => [

                ],
            ],
            [
                'title' => 'Альпинизм',
                'subcategories' => [

                ],
            ],
        ];

        foreach ($categories as $category) {
            $slug = Str::slug($category['title'], '-', 'ru', ['@' => 'at', 'ш' => 'sh']);
            $parent = Category::factory()
                ->create([
                    'title' => $category['title'],
                    'slug' => $slug,
                ]);
            foreach ($category['subcategories'] as $subcategory) {
                $slug = Str::slug($subcategory, '-');
                $parent->children()->save(Category::factory()->make([
                    'parent_id' => $parent->id,
                    'title' => $subcategory,
                    'slug' => $slug,
                ]));
            }
        }

        // DB::insert('INSERT INTO `categories` (
        //     `id`,
        //     `parent_id`,
        //     `slug`,
        //     `title`,
        //     `image`,
        //     `short_description`,
        //     `description`,
        //     `meta_title`,
        //     `meta_description`,
        //     `position`
        // )
        // SELECT
        //     `id`,
        //     `parent_id`,
        //     `slug`,
        //     `name`,
        //     `image`,
        //     `short_description`,
        //     `description`,
        //     `meta_title`,
        //     `meta_description`,
        //     `sort`
        // FROM `mtrock`.`mr_store_category`');
    }
}
