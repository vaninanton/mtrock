<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'country' => 'required',
            'city' => 'required',
            'street' => 'required',
            'house' => 'required',
            'apartment' => 'required',
            'phone' => 'required|phone:INTERNATIONAL,RU',
            'email' => 'required',
            'comment' => 'string',
        ];
    }
}
