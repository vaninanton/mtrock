<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Propaganistas\LaravelPhone\Rules\Phone;

class StoreCallbackRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'phone' => [
                'string',
                'required',
                (new Phone)->international()->country(['RU', 'KZ']),
            ],
            'timezone' => [
                'string',
            ],
        ];
    }
}
