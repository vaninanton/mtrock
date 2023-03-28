<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CartAddRequest;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public Cart $cart;

    public function index(): View
    {
        $this->getCart();

        $this->cart->load([
            'products' => [
                'brand',
                'category',
            ],
        ]);

        return view('cart', [
            'cart' => $this->cart,
        ]);
    }

    public function add(Product $product, CartAddRequest $request): RedirectResponse
    {
        $this->getCart();

        $quantity = (int) $request->input('quantity', 1);

        if ($this->cart->products->contains($product->id)) {
            $pivotRow = $this->cart->products()->where('product_id', $product->id)->withPivot('quantity')->first();
            // @phpstan-ignore-next-line
            $this->cart->products()->updateExistingPivot($product, ['quantity' => $pivotRow->pivot->quantity++]);
        } else {
            $this->cart->products()->attach($product, ['quantity' => $quantity]);
        }

        return response()->redirectToRoute('cart.index')->withStatus('ok!');
    }

    public function minus(Product $product): RedirectResponse
    {
        $this->getCart();
        // @phpstan-ignore-next-line
        $pivotRow = $this->cart->products()->where('product_id', $product->id)->first()->pivot;
        $pivotRow->quantity--;
        $pivotRow->save();
        if ($pivotRow->quantity == 0) {
            $this->cart->products()->detach($product->id, true);
        }

        return response()->redirectToRoute('cart.index')->withStatus('ok!');
    }

    public function plus(Product $product): RedirectResponse
    {
        $this->getCart();
        // @phpstan-ignore-next-line
        $pivotRow = $this->cart->products()->where('product_id', $product->id)->first()->pivot;
        $pivotRow->quantity++;
        $pivotRow->save();

        return response()->redirectToRoute('cart.index')->withStatus('ok!');
    }

    public function delete(Product $product): RedirectResponse
    {
        $this->getCart();
        $this->cart->products()->detach($product->id, true);

        return response()->redirectToRoute('cart.index')->withStatus('ok!');
    }

    private function getCart(): void
    {
        $cartId = request()->cookie('cart_id');
        $this->cart = Cart::firstOrCreate(['id' => $cartId]);

        Cookie::queue('cart_id', $this->cart->id, 525600);
    }
}
