<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;

class GenerateProductMedia extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-product-media';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $productImages = DB::table('mtrock.mr_store_product_image')
            ->whereNotNull('name')
            ->where('name', '<>', '')
            // ->limit(20)
            ->get(['product_id', 'name'])
            ->each(function ($item) {
                $item->name = 'store/product/'.$item->name;
            })
            ->groupBy('product_id');

        // dd($productImages);
        // $products = Product::query()
        //     ->latest()
        //     ->with('productImages')
        //     ->limit(2)
        //     ->get();

        foreach ($productImages as $product_id => $images) {
            try {
                $product = Product::findOrFail($product_id);
                // $product->clearMediaCollection('product-images');
                foreach ($images as $image) {
                    $res = $product->addMediaFromDisk($image->name, 'uploads')->toMediaCollection('product-images');
                    dump($res);
                }
            } catch (ModelNotFoundException|FileDoesNotExist) {
            }
        }
    }
}
