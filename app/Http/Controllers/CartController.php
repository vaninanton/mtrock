<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartAddRequest;

class CartController extends Controller
{
    public function put(CartAddRequest $request)
    {
        dd($request->validated());
    }
}
