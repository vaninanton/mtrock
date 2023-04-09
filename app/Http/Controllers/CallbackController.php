<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Events\CallbackCreated;
use App\Http\Requests\StoreCallbackRequest;
use App\Models\Callback;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;

class CallbackController extends Controller
{
    public function __invoke(StoreCallbackRequest $request)
    {
        $recentlyViewed = $this->getResentlyViewedProducts();
        $k = $recentlyViewed->mapWithKeys(fn ($item, $key) => [$item->id => ['price' => $item->price]])->toArray();

        $callback = new Callback();
        $callback->name = $request->get('name');
        $callback->phone = $request->get('phone');
        $callback->url = $request->headers->get('referer');
        $callback->timezone = $request->get('timezone');
        $callback->save();
        $callback->viewedProducts()->attach($k);

        CallbackCreated::dispatch($callback);

        return Response::noContent();
    }

    private function getResentlyViewedProducts(): ?Collection
    {
        $ids = array_reverse(array_unique(session()->get('products.recently_viewed', [])));

        $recentlyViewed = null;
        if (count($ids)) {
            $recentlyViewed = Product::query()
                ->whereIn('id', $ids)
                ->get();
        }

        return $recentlyViewed;
    }
}
