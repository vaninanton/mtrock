<?php

namespace Database\Seeders;

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
            `category_id`,
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
        FROM `mtrock_old`.`mr_store_product`
        WHERE `status` = 1');
    }
}
