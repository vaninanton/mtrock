<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartAddRequest;

class CartController extends Controller
{
    public function index()
    {
        return view('cart');
    }

    public function put(CartAddRequest $request)
    {
        dd($request->validated());
    }
}
