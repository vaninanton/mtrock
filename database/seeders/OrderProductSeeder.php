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
        Schema::disableForeignKeyConstraints();
        $old = DB::table('mtrock.mr_store_order_product')->whereNotNull('product_id')->get();
        OrderProduct::query()->truncate();
        DB::beginTransaction();
        foreach ($old as $item) {
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $item->order_id;
            $orderProduct->product_id = $item->product_id;
            $orderProduct->product_name = $item->product_name;
            $orderProduct->price = $item->price;
            $orderProduct->quantity = $item->quantity;
            $orderProduct->sku = $item->sku;
            $orderProduct->save();
        }
        DB::commit();

        Schema::enableForeignKeyConstraints();
    }
}
