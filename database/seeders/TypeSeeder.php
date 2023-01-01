<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::insert('INSERT INTO `types` (
            `id`,
            `title`,
            `title_plural`
        )
        SELECT
            `id`,
            `name`,
            `name`
        FROM `mtrock_old`.`mr_store_type`');
    }
}
