<?php

namespace App\Http\Requests\KepalaToko;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => 'required|unique:products,product_name',
            'product_code' => 'max:100',
            'nomor_seri' => 'max:100',
            'sub_categories_id' => [
                'exists:sub_categories,id',
            ],
            'stok' => 'required|max:100',
            'harga_modal' => 'required|max:100',
            'harga_jual' => 'required|max:100',
            'ppn' => 'max:100',
            'supplier' => 'max:100',
            'keterangan' => 'max:100',
            'garansi' => 'max:100',
            'garansi_imei' => 'max:100',
            'stok_minimal' => 'max:100',
        ];
    }

    public function messages()
    {
        return [
            'product_name.unique' => 'Mohon maaf, inputan tidak dapat diproses karena produk dengan nama ini sudah tersedia.',
        ];
    }
}
