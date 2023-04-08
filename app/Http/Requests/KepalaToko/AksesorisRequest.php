<?php

namespace App\Http\Requests\KepalaToko;

use Illuminate\Foundation\Http\FormRequest;

class AksesorisRequest extends FormRequest
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
            'name' => 'max:100|required|unique:accessories,name',
            'stok' => 'max:100',
            'modal' => 'max:100',
            'harga_toko' => 'max:100',
            'harga_pelanggan' => 'max:100',
            'supplier' => 'max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Mohon maaf, inputan tidak dapat diproses karena aksesori dengan nama ini sudah tersedia.',
        ];
    }
}
