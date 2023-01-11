<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DownloadProductImagesFromOldVersionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtrock:download-images-from-old-version-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Storage::disk('uploads')->makeDirectory('store/product');
        Storage::disk('uploads')->makeDirectory('store/producer');

        $files = [
            ...$this->getProductImages(),
            ...$this->getProductPhotos(),
            ...$this->getBrandImages(),
        ];

        foreach ($files as $file) {
            $folder = str_replace(basename($file), '', $file);
            $url = 'https://mountain-rock.ru/uploads/'.$folder.rawurlencode(basename($file));
            $path = Storage::disk('uploads')->path($file);
            $exists = is_file($path);

            if ($exists) {
                continue;
            }
            $this->info($file);

            try {
                $downloaded = file_put_contents($path, file_get_contents($url));
                $this->line('downloaded: '.(int) $downloaded);
            } catch (\ErrorException $th) {
                $this->error($th->getMessage());
            }
        }

        return Command::SUCCESS;
    }

    protected function getBrandImages(): array
    {
        return Brand::query()
            ->whereNotNull('image')
            ->where('image', '<>', '')
            ->get('image')
            ->map(function (Brand $item) {
                return 'store/producer/'.$item->image;
            })
            ->toArray();
    }

    protected function getProductImages(): array
    {
        return Product::query()
            ->whereNotNull('image')
            ->where('image', '<>', '')
            ->get('image')
            ->map(function (Product $item) {
                return 'store/product/'.$item->image;
            })
            ->toArray();
    }

    protected function getProductPhotos(): array
    {
        return ProductImage::query()
            ->whereNotNull('path')
            ->where('path', '<>', '')
            ->get('path')
            ->map(function (ProductImage $item) {
                return 'store/product/'.$item->path;
            })
            ->toArray();
    }
}
