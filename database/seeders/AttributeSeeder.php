<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `attributes` (
            `type`,
            `title`,
            `slug`,
            `unit`,
            `description`
        )
        SELECT
            `type`,
            `title`,
            `name`,
            `unit`,
            `description`
        FROM `mtrock`.`mr_store_attribute`
        ');
    }
}
