<?php

declare(strict_types=1);

namespace App\Console\Commands;

use GuzzleHttp\Promise\Utils;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class DownloadOldImagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtrock:download-old-images';

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
        $baseUrl = 'https://mountain-rock.ru/uploads/';
        Storage::disk('uploads')->makeDirectory('store/product');
        Storage::disk('uploads')->makeDirectory('store/producer');
        Storage::disk('uploads')->makeDirectory('news');

        $alls = [
            [
                'folder' => 'store/product/',
                'urls' => $this->getProductImages(),
            ],
            [
                'folder' => 'store/product/',
                'urls' => $this->getProductPhotos(),
            ],
            [
                'folder' => 'store/producer/',
                'urls' => $this->getBrandImages(),
            ],
            [
                'folder' => 'news/',
                'urls' => $this->getNewsImages(),
            ],
        ];

        foreach ($alls as $all) {
            $bar = $this->output->createProgressBar(count($all));
            $bar->setFormat('debug');
            $bar->start();

            $chunks = $all['urls']->chunk(30);
            foreach ($chunks as $files) {
                $promises = [];
                foreach ($files as $file) {
                    $url = $baseUrl . $all['folder'] . rawurlencode(basename($file));
                    $path = Storage::path($file);

                    if (!is_file($path)) {
                        $promises[] = Http::async()->sink($path)->get($url);
                    }
                    $bar->advance();
                }
                Utils::unwrap($promises);
            }

            $bar->finish();
            $this->newLine();
        }

        return Command::SUCCESS;
    }

    protected function getBrandImages(): Collection
    {
        return DB::table('mtrock.mr_store_producer')
            ->whereNotNull('image')
            ->where('image', '<>', '')
            ->pluck('image', 'id')
            ->map(fn (string $file): string => 'store/producer/' . $file);
    }

    protected function getProductImages(): Collection
    {
        return DB::table('mtrock.mr_store_product')
            ->whereNotNull('image')
            ->where('image', '<>', '')
            ->pluck('image', 'id')
            ->map(fn (string $file): string => 'store/product/' . $file);
    }

    protected function getNewsImages(): Collection
    {
        return DB::table('mtrock.mr_news_news')
            ->whereNotNull('image')
            ->where('image', '<>', '')
            ->pluck('image', 'id')
            ->map(fn (string $file): string => 'news/' . $file);
    }

    protected function getProductPhotos(): Collection
    {
        return DB::table('mtrock.mr_store_product_image')
            ->whereNotNull('name')
            ->where('name', '<>', '')
            ->pluck('name', 'id')
            ->map(fn (string $file): string => 'store/product/' . $file);
    }
}
