<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'series' => 'required',
            'name' => 'required',
            'number' => 'required',
            'amount' => 'required|int',
            'order_price' => 'required|numeric',
            'list_price' => 'required|numeric',
            'estimated_price' => 'required|numeric',
            'shop' => 'required',
            'order_date' => 'required|date|date_format:Y-m-d',
            'delivery_date' => 'required|date|date_format:Y-m-d',
        ];
    }
}
