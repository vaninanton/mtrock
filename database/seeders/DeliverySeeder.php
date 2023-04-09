<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Delivery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        $old = DB::table('mtrock.mr_store_delivery')->get();
        Delivery::query()->truncate();
        foreach ($old as $item) {
            $delivery = new Delivery();
            $delivery->id = $item->id;
            $delivery->title = strip_tags($item->name);
            $delivery->short_name = $item->short_name ?: null;
            $delivery->description = $item->description;
            $delivery->price = $item->price;
            $delivery->free_from = $item->free_from;
            $delivery->available_from = $item->available_from;
            $delivery->position = $item->position;
            $delivery->flag_separate_payment = $item->separate_payment;
            $delivery->deleted_at = $item->status == 1 ? null : now();
            $delivery->save();
        }
        Schema::enableForeignKeyConstraints();
    }
}
