<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `news` (
            `id`,
            `slug`,
            `title`,
            `short_text`,
            `full_text`,
            `image`,
            `link`,
            `video`,
            `created_at`
        )
        SELECT
            `id`,
            `slug`,
            `title`,
            `short_text`,
            `full_text`,
            `image`,
            `link`,
            `video`,
            `create_time` AS created_at
        FROM `mtrock_old`.`mr_news_news`
        WHERE `status` = 1');
    }
}
