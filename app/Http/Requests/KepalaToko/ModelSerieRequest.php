<?php

namespace App\Http\Requests\KepalaToko;

use Illuminate\Foundation\Http\FormRequest;

class ModelSerieRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'max:100|required|unique:model_series,name',
            'brands_id' => [
                'exists:brands,id'
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Mohon maaf, inputan tidak dapat diproses karena model seri dengan nama ini sudah tersedia.',
        ];
    }
}
