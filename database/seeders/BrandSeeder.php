<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `brands` (
            `id`,
            `slug`,
            `title`,
            `image`,
            `short_description`,
            `description`,
            `position`
        )
        SELECT
            `id`,
            `slug`,
            `name`,
            `image`,
            `short_description`,
            REPLACE(`description`, "https://mountain-rock.ru/", "/"),
            `sort`
        FROM `mtrock`.`mr_store_producer`
        WHERE `status` = 1');
    }
}
