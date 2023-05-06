<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Http\Requests\CartAddRequest;
use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

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
            $this->cart->products()->updateExistingPivot($product, ['quantity' => $pivotRow->getRelationValue('pivot')->quantity++]);
        } else {
            $this->cart->products()->attach($product, ['quantity' => $quantity]);
        }

        return response()->redirectToRoute('cart.index')->withStatus('ok!');
    }

    public function minus(Product $product): RedirectResponse
    {
        $this->getCart();
        $pivotRow = $this->cart->products()->where('product_id', $product->id)->first()->getRelationValue('pivot');
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
        $pivotRow = $this->cart->products()->where('product_id', $product->id)->first()->getRelationValue('pivot');
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

    public function checkout(CheckoutRequest $request)
    {
        $this->getCart();
        $this->cart->load('products');

        $order = new Order();
        // $order->client_id = $request->get('client_id');
        $order->slug = Str::random(16);
        // $order->delivery_id = $request->get('delivery_id');
        // $order->delivery_price = $request->get('delivery_price');
        // $order->pay_method = $request->get('pay_method');
        $order->total_price = $this->cart->products->sum(fn (Product $product) => $product->price * $product->getRelationValue('pivot')->quantity);
        // $order->coupon_discount = $request->get('coupon_discount');
        // $order->separate_delivery = $request->get('separate_delivery');
        $order->status = OrderStatus::NEW;
        $order->name = $request->get('first_name').' '.$request->get('last_name');
        $order->country = $request->get('country');
        $order->city = $request->get('city');
        $order->street = $request->get('street');
        $order->house = $request->get('house');
        $order->apartment = $request->get('apartment');
        $order->phone = $request->get('phone');
        $order->phone_country = $request->get('phone_country');
        $order->email = $request->get('email');
        $order->comment = $request->get('comment');
        // $order->note = $request->get('note');
        // $order->payment_link = $request->get('payment_link');
        $order->ip_address = $request->ip();
        // $order->paid_at = null;
        $order->save();

        foreach ($this->cart->products as $cartProduct) {
            $orderProduct = new OrderProduct();
            $orderProduct->order()->associate($order);
            $orderProduct->product()->associate($cartProduct);
            $orderProduct->product_name = $cartProduct->title;
            $orderProduct->sku = $cartProduct->sku;
            $orderProduct->price = $cartProduct->price;
            $orderProduct->quantity = $cartProduct->getRelationValue('pivot')->quantity;
            $orderProduct->save();
        }
        dump($order->toArray(), $request->all(), $this->cart->products->toArray());
    }
}
