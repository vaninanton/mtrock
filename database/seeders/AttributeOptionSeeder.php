<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT IGNORE INTO `attribute_options` (
            `id`,
            `attribute_id`,
            `value`,
            `position`
        )
        SELECT
            `id`,
            `attribute_id`,
            `value`,
            `position`
        FROM `mtrock`.`mr_store_attribute_option`
        ');
    }
}
