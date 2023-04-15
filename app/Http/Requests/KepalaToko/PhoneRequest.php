<?php

namespace App\Http\Requests\KepalaToko;

use Illuminate\Foundation\Http\FormRequest;

class PhoneRequest extends FormRequest
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
            'brands_id' => [
                'exists:brands,id'
            ],
            'model_series_id' => [
                'exists:model_series,id'
            ],
            'kondisi' => 'max:100',
            'keterangan' => 'max:100',
            'imei' => 'max:100|unique:phones,imei',
            'stok' => 'max:100',
            'warna' => 'max:100',
            'ram' => 'max:100',
            'kapasitas' => 'max:100',
            'modal' => 'max:100',
            'harga_toko' => 'max:100',
            'harga_pelanggan' => 'max:100',
            'supplier' => 'max:100',
        ];
    }

    public function messages()
    {
        return [
            'imei.unique' => 'Mohon maaf, inputan tidak dapat diproses karena handphone dengan IMEI ini sudah tersedia.',
        ];
    }
}
