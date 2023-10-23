<?php

namespace App\Http\Requests\KepalaToko;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'nama' => 'required|max:100',
            'kategori' => 'required|max:100',
            'nomor_hp' => 'required|unique:customers,nomor_hp',
            'alamat' => 'required|max:100',
        ];
    }

    public function messages()
    {
        return [
            'nomor_hp.unique' => 'Mohon maaf, inputan tidak dapat diproses karena pelanggan dengan nomor hp ini sudah tersedia.',
        ];
    }
}
