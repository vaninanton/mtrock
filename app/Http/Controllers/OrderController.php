<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Order $order)
    {
        $order->load([
            'client',
            'delivery',
            'products.product',
        ]);

        return view('order.show', compact('order'));
    }
}
