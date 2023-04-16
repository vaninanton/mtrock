<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\News;
use App\Models\NewsProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oldNews = DB::table('mtrock.mr_news_news')->get();
        $result = $oldNews->map(fn ($item) => [
            'id' => $item->id,
            'slug' => $item->slug,
            'title' => $item->title,
            'short_description' => $this->getShortDescription($item->short_text),
            'description' => $item->full_text,
            'image' => $this->getImage($item->image),
            'link' => $item->link ?: null,
            'video' => $item->video ?: null,
            // 'product_id' => $item->product_id ?: null,
            'created_at' => $item->create_time,
            'updated_at' => $item->update_time,
            'deleted_at' => $item->status == 0 ? now() : null,
        ]);

        $newsProducts = $oldNews->map(fn ($item) => [
            'news_id' => $item->id,
            'product_id' => $item->product_id ?: null,
        ])->filter(fn ($item) => $item['product_id']);

        Schema::disableForeignKeyConstraints();
        News::query()->truncate();
        NewsProduct::query()->truncate();

        News::insert($result->toArray());
        NewsProduct::insert($newsProducts->toArray());
        Schema::enableForeignKeyConstraints();
    }

    private function getImage(?string $image): ?string
    {
        if (empty($image)) {
            return null;
        }

        return 'store/news/'.$image;
    }

    private function getShortDescription(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }

        return strip_tags($value);
    }
}
