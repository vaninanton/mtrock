<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\OrderProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $old = DB::table('mtrock.mr_store_order_product')->whereNotNull('product_id')->get();

        $result = $old->map(fn ($item) => [
            'order_id' => $item->order_id,
            'product_id' => $item->product_id,
            'product_name' => $item->product_name ?: null,
            'price' => $item->price ?: 0,
            'quantity' => $item->quantity ?: 0,
            'sku' => $item->sku ?: null,
        ]);

        Schema::disableForeignKeyConstraints();
        OrderProduct::query()->truncate();
        foreach (array_chunk($result->toArray(), 10) as $values) {
            OrderProduct::query()->insert($values);
        }
        Schema::enableForeignKeyConstraints();
    }
}
