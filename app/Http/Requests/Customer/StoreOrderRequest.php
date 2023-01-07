<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'order_code' => ['required', 'string', 'max:255'],
            'total_items' => ['required', 'integer'],
            'total_price' => ['required', 'integer'],
            'status' => ['required', 'in:pending,delivered,canceled'],
            'item_code' => ['required', 'string'],
            'item_colour' => ['required', 'string'],
            'item_size' => ['required', 'string'],
            'item_quantity' => ['required', 'integer'],
            'item_price' => ['required', 'integer'],
            'item_id' => ['required', 'integer'],
            'item_link' => ['required', 'url'],
        ];
    }
}
