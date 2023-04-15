<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Propaganistas\LaravelPhone\Exceptions\NumberParseException;
use Propaganistas\LaravelPhone\PhoneNumber;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $oldOrders = DB::table('mtrock.mr_store_order')->get(['name', 'phone', 'email', 'date']);
        $oldCallbacks = DB::table('mtrock.mr_callback')->get(['name', 'phone', 'create_time']);

        $result = $oldOrders->map(fn ($oldOrder) => [
            'name' => $oldOrder->name,
            'phone' => $this->phoneFormat($oldOrder->phone),
            'email' => $oldOrder->email,
            'created_at' => $oldOrder->date,
        ]);

        $result = $result->merge($oldCallbacks->map(fn ($oldCallback) => [
            'name' => $oldCallback->name,
            'phone' => $this->phoneFormat($oldCallback->phone),
            'email' => null,
            'created_at' => $oldCallback->create_time,
        ]));

        $result = $result->unique(function ($item) {
            return $item['phone'].strtolower($item['email'] ?: '');
        });

        Schema::disableForeignKeyConstraints();
        Client::query()->truncate();
        Client::insert($result->toArray());

        DB::update('UPDATE `callbacks` LEFT JOIN `clients` ON `clients`.`phone` = `callbacks`.`phone` SET `callbacks`.`client_id` = `clients`.`id`');
        DB::update('UPDATE `orders` LEFT JOIN `clients` ON `clients`.`phone` = `orders`.`phone` SET `orders`.`client_id` = `clients`.`id`');
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
