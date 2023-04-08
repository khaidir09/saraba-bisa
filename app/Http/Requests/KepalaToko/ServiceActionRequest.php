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
            'nama_tindakan' => 'required|unique:service_actions,nama_tindakan',
            'modal_sparepart' => 'required',
            'harga_toko' => 'required',
            'harga_pelanggan' => 'required',
            'garansi' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama_tindakan.unique' => 'Mohon maaf, inputan tidak dapat diproses karna tindakan servis dengan nama ini sudah tersedia.',
        ];
    }
}
