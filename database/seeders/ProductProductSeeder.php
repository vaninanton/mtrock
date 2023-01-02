<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT IGNORE INTO `product_product` (
            `type`,
            `product_id`,
            `linked_product_id`
        )
        SELECT
            "similar",
            `product_id`,
            `linked_product_id`
        FROM `mtrock`.`mr_store_product_link`
        WHERE `type_id` = 1
        ');
        DB::insert('INSERT IGNORE INTO `product_product` (
            `type`,
            `product_id`,
            `linked_product_id`
        )
        SELECT
            "related",
            `product_id`,
            `linked_product_id`
        FROM `mtrock`.`mr_store_product_link`
        WHERE `type_id` = 2
        ');
        DB::insert('INSERT IGNORE INTO `product_product` (
            `type`,
            `product_id`,
            `linked_product_id`
        )
        SELECT
            "set",
            `product_id`,
            `linked_product_id`
        FROM `mtrock`.`mr_store_product_link`
        WHERE `type_id` = 3
        ');
    }
}
