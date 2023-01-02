<?php

namespace Database\Seeders;

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
    }
}
