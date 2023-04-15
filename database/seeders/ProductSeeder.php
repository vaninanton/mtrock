<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $old = DB::table('mtrock.mr_store_product')->where('category_id', '!=', 1015)->get();
        $result = $old->map(fn ($item) => [
            'id' => $item->id,
            'title' => $item->name,
            'slug' => $item->slug,
            'sku' => $item->sku,
            'category_id' => null,
            'brand_id' => $item->producer_id,
            'type_id' => $item->type_id,
            'quantity' => $this->setZero($item->quantity),
            'in_stock' => $this->setBoolean($item->in_stock),
            'price' => $item->price,
            'old_price' => $item->old_price,
            'type_prefix' => $item->type_prefix,
            'model' => $item->model,
            'image' => $this->getImage($item->image),
            'short_description' => $this->getShortDescription($item->short_description),
            'description' => $item->description,
            'flag_new' => $this->setBoolean($item->is_new),
            'flag_hit' => $this->setBoolean($item->is_hit),
            'length' => $item->length,
            'width' => $item->width,
            'height' => $item->height,
            'weight' => $item->weight,
            'availability_preorder' => $this->setBoolean($item->availability_preorder),
            'status' => $item->status,
            'sales_notes' => $item->sales_notes,
            'video1' => $item->video1,
            'video2' => $item->video2,
            'video3' => $item->video3,
            'created_at' => $item->create_time,
            'updated_at' => $item->update_time,
        ]);

        Schema::disableForeignKeyConstraints();
        Product::query()->truncate();
        foreach (array_chunk($result->toArray(), 500) as $values) {
            Product::query()->insert($values);
        }
        Schema::enableForeignKeyConstraints();

        $categories = [
            'Палатки' => ['Палатка'],
            'Спальные мешки' => ['Спальник'],
            'Рюкзаки' => ['Рюкзак'],
            'Походная посуда' => ['Туристическая посуда', 'Термос', 'Фильтр для воды'],
            'Горелки туристические' => ['Горелка'],
            'Туристические коврики' => ['Самонадувающийся коврик', 'Коврик туристический'],
            'Кемпинговая мебель' => ['Кемпинговая мебель'],
            'Аксессуары' => ['Аксессуары', 'Мультитул', 'Гамаши', 'Аптечка туристическая'],
            'Гермомешки, гермобаулы' => ['Гермомешок'],
            'Тенты' => ['Каркасный тент', 'Туристический тент'],
            'Треккинговые палки' => ['Треккинговые палки', 'Палки для скандинавской ходьбы'],
            'Самокаты' => ['Самокаты'],
            'Снегоступы' => ['Снегоступы'],
            'Дорожные, вело и поясные сумки' => ['Сумка дорожная', 'Мешок компрессионный', 'Сумка'],
            'Лонгборды и круизёры' => ['Лонгборд'],
            'Фонари и источники питания' => ['Фонарь', 'Power Bank'],
            'Лавинное снаряжение' => ['Лавинное снаряжение'],
            'Альпинизм' => ['Альпинистские кошки'],
        ];

        foreach ($categories as $category => $types) {
            try {
                $category_id = Category::whereTitle($category)->first()->id;
                Product::whereBelongsTo(Type::whereIn('title', $types)->get())->update(['category_id' => $category_id]);
            } catch (\Throwable $th) {
                dump($category.' not found');
                throw $th;
            }
        }
        $category_id = Category::whereTitle('Горелки туристические')->first()->id;
        Product::whereBelongsTo(Brand::where('title', 'Kovea')->get())->update(['category_id' => $category_id]);
    }

    private function setBoolean(string|int|null $value): bool
    {
        if (empty($value)) {
            return false;
        }

        return (bool) $value;
    }

    private function setZero(string|int|null $value): int
    {
        if (empty($value) || !is_numeric($value) || $value < 0) {
            return 0;
        }

        return (int) $value;
    }

    private function getImage(?string $image): ?string
    {
        if (empty($image)) {
            return null;
        }

        return 'store/product/'.$image;
    }

    private function getShortDescription(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }

        return trim(strip_tags($value));
    }
}
