<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `categories` (
            `id`,
            `parent_id`,
            `slug`,
            `title`,
            `image`,
            `short_description`,
            `description`,
            `meta_title`,
            `meta_description`,
            `position`
        )
        SELECT
            `id`,
            `parent_id`,
            `slug`,
            `name`,
            `image`,
            `short_description`,
            `description`,
            `meta_title`,
            `meta_description`,
            `sort`
        FROM `mtrock_old`.`mr_store_category`');
    }
}
