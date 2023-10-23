<?php

namespace App\Http\Requests\KepalaToko;

use Illuminate\Foundation\Http\FormRequest;

class CapacityRequest extends FormRequest
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
            'name' => 'max:100|required|unique:capacities,name',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Mohon maaf, inputan tidak dapat diproses karena kapasitas dengan nama ini sudah tersedia.',
        ];
    }
}
