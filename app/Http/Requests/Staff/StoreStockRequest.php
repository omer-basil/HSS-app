<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockRequest extends FormRequest
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
            'colour_name' => ['required', 'string', 'unique:colours', 'max:255'],
            'colour_image' => ['required', 'image'],
            'size_name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer'],
            'colour_id' => ['required', 'integer']
        ];
    }
}
