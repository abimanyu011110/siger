<?php

namespace App\Http\Requests\adminpemda;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class reqOPD extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            //
            'nama_opd' => 'required',
            'kepala_opd' => 'required',
            'jabatan' => 'required',
        ];
    }

    public function messages() 
    {
        return [
            'nama_opd.required' => 'Nama OPD harus diisi',
            'kepala_opd.required' => 'Nama Kepala OPD harus diisi',
            'jabatan.required' => 'Jabatan harus diisi',
        ];
    }

}
