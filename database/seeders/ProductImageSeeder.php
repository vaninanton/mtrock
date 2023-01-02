<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT IGNORE INTO `product_images` (
            `product_id`,
            `path`
        )
        SELECT
            `product_id`,
            `name`
        FROM `mtrock`.`mr_store_product_image`
        ');
    }
}
