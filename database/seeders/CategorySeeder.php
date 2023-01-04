<?php

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
                    'Легкие палатки',
                    'Быстросборные палатки',
                    'Тенты и шатры',
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
                'title' => 'Посуда и горелки',
                'subcategories' => [
                    'Горелки',
                    'Аксессуары для газового оборудования',
                ],
            ],
            [
                'title' => 'Походная посуда',
                'subcategories' => [
                    'Туристические кружки',
                    'Котелки и чайники',
                    'Столовые приборы',
                    'Термосы и фляги',
                    'Посуда',
                    // 'Аксессуары',
                ],
            ],
            [
                'title' => 'Туристические коврики',
                'subcategories' => [

                ],
            ],
            [
                'title' => 'Кемпинговая мебель',
                'subcategories' => [

                ],
            ],
            [
                'title' => 'Аксессуары',
                'subcategories' => [

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
                    'Палатки душ-туалет',
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
            $slug = Str::slug($category['title'], '-');
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
