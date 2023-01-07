<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
        $rules1 = [
            'i_code' => ['required', 'string', 'max:255'],
            'i_price' => ['required', 'integer', 'max:3'],
            'model' => ['required'],
            'category' => ['required'],
            'brand' => ['required']
        ];

        $rules2 = [];

        foreach (config('app.available_locales') as $locale) {
            $rules2["i_name_$locale"] = ['required', 'string', 'max:255'];
            $rules2["description_$locale"] = ['required', 'string', 'max:255'];
        }

        $rules = array_merge($rules1, $rules2);
    }
}
