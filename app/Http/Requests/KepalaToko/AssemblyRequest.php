<?php

namespace App\Http\Requests\KepalaToko;

use Illuminate\Foundation\Http\FormRequest;

class AssemblyRequest extends FormRequest
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
            'imei' => 'max:100|required|unique:assemblies,imei',
            'item' => 'max:100',
            'biaya' => 'max:100',
            'warna' => 'max:100',
            'kapasitas' => 'max:100',
            'supplier' => 'max:100',
        ];
    }

    public function messages()
    {
        return [
            'imei.unique' => 'Mohon maaf, inputan tidak dapat diproses karena item perakitan dengan imei ini sudah tersedia.',
        ];
    }
}
