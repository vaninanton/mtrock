<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartAddRequest extends FormRequest
{
    /** @return array<string, mixed> */
    public function rules()
    {
        return [
            'quantity' => [
                'integer',
                'min:1',
            ],
        ];
    }
}
