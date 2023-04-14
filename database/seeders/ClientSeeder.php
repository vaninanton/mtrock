<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Propaganistas\LaravelPhone\Exceptions\NumberParseException;
use Propaganistas\LaravelPhone\PhoneNumber;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $oldCallbacks = DB::table('mtrock.mr_callback')->get(['name', 'phone']);
        $oldOrders = DB::table('mtrock.mr_store_order')->get(['name', 'phone', 'email']);

        $result = collect();
        $result = $result->merge($oldCallbacks->map(fn ($oldCallback) => [
            'name' => $oldCallback->name,
            'phone' => $this->phoneFormat($oldCallback->phone),
            'email' => null,
        ]));
        $result = $result->merge($oldOrders->map(fn ($oldOrder) => [
            'name' => $oldOrder->name,
            'phone' => $this->phoneFormat($oldOrder->phone),
            'email' => $oldOrder->email,
        ]));

        $result = $result->unique('phone')->unique('email');

        Client::query()->truncate();
        Client::insert($result->toArray());
    }

    private function phoneFormat($phone): ?string
    {
        try {
            $phone = new PhoneNumber($phone, ['RU', 'UK', 'BY']);

            return $phone->formatInternational();
        } catch (NumberParseException) {
        }

        return null;
    }
}
