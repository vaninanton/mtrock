<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Propaganistas\LaravelPhone\PhoneNumber;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        $old = DB::table('mtrock.mr_store_order')->get();
        Order::query()->truncate();
        DB::beginTransaction();
        foreach ($old as $item) {
            $order = new Order();
            $order->id = $item->id;
            $order->slug = $item->url;
            $order->delivery_id = $item->delivery_id ?: null;
            $order->delivery_price = $item->delivery_price ?: null;
            $order->pay_method = $item->payment_method_id ?: null;
            $order->total_price = $item->total_price ?: null;
            $order->coupon_discount = $item->coupon_discount ?: null;
            $order->separate_delivery = $item->separate_delivery ?: false;
            $order->status = $item->status_id;
            $order->name = $item->name ?: null;
            $order->country = $item->country ?: null;
            $order->city = $item->city ?: null;
            $order->street = $item->street ?: null;
            $order->house = $item->house ?: null;
            $order->apartment = $item->apartment ?: null;
            try {
                $phone = new PhoneNumber($item->phone);
                if (is_null($phone->getCountry())) {
                    throw new \Exception('Error Processing Request');
                }
                $order->phone = $phone->getRawNumber();
                $order->phone_country = $phone->getCountry();
            } catch (\Throwable $th) {
                logger()->channel('stderr')->alert($th->getMessage().' '.$item->phone);
            }
            $order->email = $item->email ?: null;
            $order->comment = $item->comment ?: null;
            $order->note = $item->note ?: null;
            $order->payment_link = $item->payment_link ?: null;
            $order->ip_address = $item->ip ?: null;
            $order->paid_at = $item->paid ? $item->modified : null;
            $order->created_at = $item->date;
            $order->updated_at = $item->modified;

            $order->save();
        }
        DB::commit();
        Schema::enableForeignKeyConstraints();
    }
}
