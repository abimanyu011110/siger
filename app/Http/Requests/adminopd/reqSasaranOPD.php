<?php

namespace App\Http\Requests\adminopd;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class reqSasaranOPD extends FormRequest
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
            'tujuan_id' => 'required',
            'nama_sasaran' => 'required',
        ];
    }

    public function messages()
    {
        return [
        'tujuan_id.required' => 'Silahkan pilih tujuan.',
        'nama_sasaran.required' => 'Nama sasaran harus diisi.',
        ];
    }
}
