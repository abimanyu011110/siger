<?php

namespace App\Http\Requests\adminopd;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class reqTujuanOPD extends FormRequest
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
            'misi_id' => 'required',
            'nama_tujuan' => 'required',
        ];
    }

    public function messages()
    {
        return [
        'misi_id.required' => 'Silahkan pilih misi.',
        'nama_tujuan.required' => 'Nama tujuan harus diisi.',
        ];
    }
}
