<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CartAddRequest extends FormRequest
{
    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'product_id' => [
                'required',
                Rule::exists(Product::class, 'id')->where(fn (Builder $query) => $query->where('in_stock', 1)),
            ],
            'quantity' => [
                'required',
                'integer',
            ],
        ];
    }
}
