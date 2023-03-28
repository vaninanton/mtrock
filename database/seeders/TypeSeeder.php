<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
            TRIM(`name`),
            TRIM(`name`)
        FROM `mtrock`.`mr_store_type`');
    }
}
