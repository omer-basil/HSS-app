<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
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
            'i_code' => ['required', 'string', 'max:255'],
            'i_name' => ['required', 'string', 'max:255'],
            'i_price' => ['required', 'integer', 'max:3'],
            'model' => ['required'],
            'category' => ['required'],
            'brand' => ['required']
        ];
    }
}
