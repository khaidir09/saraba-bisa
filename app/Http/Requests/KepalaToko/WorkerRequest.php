<?php

namespace App\Http\Requests\KepalaToko;

use Illuminate\Foundation\Http\FormRequest;

class WorkerRequest extends FormRequest
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
            'name' => 'required|max:100|unique:workers,name',
            'jabatan' => 'required|max:100',
            'status' => 'max:50',
            'bulankerja' => 'required|date',
            'gaji' => 'max:50',
            'absen' => 'max:255',
            'bpjs' => 'max:50'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Mohon maaf, inputan tidak dapat diproses karena karyawan dengan nama ini sudah tersedia.',
        ];
    }
}
