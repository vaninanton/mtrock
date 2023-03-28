<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `params` (
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
