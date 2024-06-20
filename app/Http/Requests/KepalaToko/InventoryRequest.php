<?php

namespace App\Http\Requests\KepalaToko;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequest extends FormRequest
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
            'code' => 'max:100|required|unique:inventories,code',
        ];
    }

    public function messages()
    {
        return [
            'code.unique' => 'Mohon maaf, inputan tidak dapat diproses karena inventaris dengan kode ini sudah tersedia.',
        ];
    }
}
