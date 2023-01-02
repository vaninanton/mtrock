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
            'Палатки',
            'Спальные мешки',
            'Рюкзаки',
            'Горелки и газовое оборудование',
            'Походная посуда',
            'Туристические коврики и подушки',
            'Кемпинговая мебель',
            'Аксессуары',
            'Гермомешки, гермобаулы',
            'Тенты',
            'Треккинговые палки',
            'Самокаты',
            'Снегоступы',
            'Дорожные, вело и поясные сумки',
            'Лонгборды и круизёры',
            'Фонари и источники питания',
            'Лавинное снаряжение',
            'Альпинизм',
        ];

        foreach ($categories as $category) {
            $slug = Str::slug($category, '-');
            Category::factory()
                ->create([
                    'title' => $category,
                    'slug' => $slug,
                ]);
            // $count = rand(0, 5);
            // $parent->children()->saveMany(Category::factory($count)->make([
            //     'parent_id' => $parent->id,
            // ]));
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
