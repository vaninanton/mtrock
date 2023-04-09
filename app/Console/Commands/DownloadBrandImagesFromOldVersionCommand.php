<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Brand;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DownloadBrandImagesFromOldVersionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtrock:download-brand-images-from-old-version-command';

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
        Storage::makeDirectory('store/brand');
        $import_path = Storage::path('store/brand');

        Brand::query()
            ->whereNotNull('image')
            ->get(['id', 'image'])
            ->each(function (Brand $item) use ($import_path) {
                if (is_file($import_path.'/'.$item->image)) {
                    return true;
                }

                $data = file_get_contents('https://mountain-rock.ru/uploads/store/producer/'.$item->image);
                file_put_contents($import_path.'/'.$item->image, $data);
            });

        return Command::SUCCESS;
    }
}
