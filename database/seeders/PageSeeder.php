<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `pages` (
            `id`,
            `title`,
            `slug`,
            `body`,
            `meta_description`
        )
        SELECT
            `id`,
            `title`,
            `slug`,
            `body`,
            `meta_description`
        FROM `mtrock`.`mr_page_page`
        WHERE `status` = 1');
    }
}
