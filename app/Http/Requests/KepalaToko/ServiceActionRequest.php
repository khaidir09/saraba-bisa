<?php

namespace App\Http\Requests\KepalaToko;

use Illuminate\Foundation\Http\FormRequest;

class ServiceActionRequest extends FormRequest
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
            'nama_tindakan' => 'max:100',
            'modal_sparepart' => 'max:100',
            'harga_toko' => 'max:50',
            'harga_pelanggan' => 'max:100',
            'garansi' => 'max:50',
        ];
    }
}
