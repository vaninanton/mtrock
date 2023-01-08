<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\Product;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Response;
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
        Storage::disk('uploads')->makeDirectory('store/brand');
        $import_path = Storage::disk('uploads')->path('store/brand');

        $files = Brand::query()
            ->whereNotNull('image')
            ->get(['id', 'image'])
            ->each(function (Brand $item) use ($import_path) {
                // dd($import_path.'/'.$item->image, 'https://mountain-rock.ru/uploads/store/producer/'.$item->image);
                $data = file_get_contents('https://mountain-rock.ru/uploads/store/producer/'.$item->image);
                file_put_contents($import_path.'/'.$item->image, $data);

                // return config('app.uploads_url').'/store/producer/'.$item->image;
            });
        dd($files);

        // $client = new Client();
        // $requests = function ($total) use ($client, $files, $import_path) {
        //     foreach ($files as $file) {
        //         yield function ($poolOpts) use ($client, $file, $import_path) {
        //             $reqOpts = array_merge($poolOpts, [
        //                 'sink' => $import_path.'/'.basename($file),
        //             ]);

        //             return $client->getAsync($file, $reqOpts);
        //         };
        //     }
        // };

        // $pool = new Pool($client, $requests(100), [
        //     'concurrency' => 3,
        //     'fulfilled' => function (Response $response, $index) {
        //         // Grab the URLs this file redirected through to download in chronological order.
        //         $urls = $response->getHeader(\GuzzleHttp\RedirectMiddleware::HISTORY_HEADER);

        //         echo 'Downloaded ', end($urls), "<br/>\n";
        //     },
        // ]);

        // $pool->promise()->wait();

        return Command::SUCCESS;
    }
}
