<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Callback;
use App\Models\CallbackProduct;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Propaganistas\LaravelPhone\Exceptions\NumberParseException;
use Propaganistas\LaravelPhone\PhoneNumber;

class CallbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $oldCallbacks = DB::table('mtrock.mr_callback')->get();

        $result = $oldCallbacks->map(fn ($oldCallback) => [
            'id' => $oldCallback->id,
            'name' => $oldCallback->name,
            'phone' => $this->phoneFormat($oldCallback->phone),
            'url' => $oldCallback->url ?: null,
            'comment' => $oldCallback->comment ?: null,
            'created_at' => $oldCallback->create_time,
            'updated_at' => $oldCallback->create_time,
            'answered_at' => $oldCallback->status != 0 ? $oldCallback->create_time : null,
        ]);

        $products = $oldCallbacks
            ->filter(fn ($item) => $item->viewed_products)
            ->map(function ($oldCallback): array {
                $products = explode(PHP_EOL, $oldCallback->viewed_products);

                $result = [];
                foreach ($products as $item) {
                    preg_match('/<a href=".+\/(.+).html">/', $item, $match);
                    $product = Product::query()
                        ->withTrashed()
                        ->where('slug', '=', $match[1])
                        ->first('id');
                    if (!$product) {
                        dump($item);

                        continue;
                    }
                    $result[] = [
                        'callback_id' => $oldCallback->id,
                        'product_id' => $product?->id,
                    ];
                }

                return $result;
            })
            ->flatten(1);

        Schema::disableForeignKeyConstraints();
        Callback::query()->truncate();
        CallbackProduct::query()->truncate();

        Callback::insert($result->toArray());
        CallbackProduct::insert($products->toArray());
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
