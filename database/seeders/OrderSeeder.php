<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Propaganistas\LaravelPhone\Exceptions\NumberParseException;
use Propaganistas\LaravelPhone\PhoneNumber;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $oldOrders = DB::table('mtrock.mr_store_order')->get();

        $result = $oldOrders->map(fn ($item) => [
            'id' => $item->id,
            'slug' => $item->url,
            'delivery_id' => $item->delivery_id ?: null,
            'delivery_price' => $item->delivery_price ?: null,
            'pay_method' => $item->payment_method_id ?: null,
            'total_price' => $item->total_price ?: null,
            'coupon_discount' => $item->coupon_discount ?: null,
            'separate_delivery' => $item->separate_delivery ?: false,
            'status' => $item->status_id,
            'name' => $item->name ?: null,
            'country' => $item->country ?: null,
            'city' => $item->city ?: null,
            'street' => $item->street ?: null,
            'house' => $item->house ?: null,
            'apartment' => $item->apartment ?: null,
            'email' => $item->email ?: null,
            'comment' => $item->comment ?: null,
            'note' => $item->note ?: null,
            'payment_link' => $item->payment_link ?: null,
            'ip_address' => $item->ip ?: null,
            'paid_at' => $item->paid ? $item->modified : null,
            'created_at' => $item->date,
            'updated_at' => $item->modified,
            'phone' => $this->phoneFormat($item->phone),
        ]);

        Schema::disableForeignKeyConstraints();
        Order::query()->truncate();
        foreach (array_chunk($result->toArray(), 1000) as $values) {
            Order::query()->insert($values);
        }
        // DB::update('UPDATE `orders` LEFT JOIN `clients` ON `clients`.`phone` = `orders`.`phone` SET `orders`.`client_id` = `clients`.`id`');
        DB::update('UPDATE `orders` LEFT JOIN `clients` ON `clients`.`email` = `orders`.`email` SET `orders`.`client_id` = `clients`.`id`');
        Schema::enableForeignKeyConstraints();
    }

    private function phoneFormat($phone): ?string
    {
        try {
            $phone = new PhoneNumber($phone, ['RU', 'UK', 'BY']);

            return $phone->formatE164();
        } catch (NumberParseException) {
        }

        return null;
    }
}
