<?php

namespace App\Http\Requests\adminpemda;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class reqPemda extends FormRequest
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
            'tahun' => 'required',
            'nama_pemda' => 'required',
            'alamat' => 'required',
            'kepala_daerah' => 'required',
            'jabatan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tahun.required' => 'Silahkan isi data tahun.',
            'nama_pemda.required' => 'Silahkan isi nama pemerintah daerah.',
            'alamat.required' => 'Silahkan isi alamat pemerintah daerah.',
            'kepala_daerah.required' => 'Silahkan isi kepala pemerintah daerah.',
            'jabatan.required' => 'Silahkan isi jabatan kepala pemerintah daerah.',
        ];
    }
}
