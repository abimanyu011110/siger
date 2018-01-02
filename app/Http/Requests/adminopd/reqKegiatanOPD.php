<?php

namespace App\Http\Requests\adminopd;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class reqKegiatanOPD extends FormRequest
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
            'program_id' => 'required',
            'nama_kegiatan' => 'required',
            'bobot' => 'required',
            'nama' => 'required',
            'jabatan' => 'required',

        ];
    }

    public function messages()
    {
        return [
        'program_id.required' => 'Silahkan isi program pemerintah daerah.',
        'nama_kegiatan.required' => 'Silahkan isi kegiatan pemerintah daerah.',
        'bobot.required' => 'Silahkan isi bobot.',
        'nama.required' => 'Silahkan isi nama pemilik risiko.',
        'jabatan.required' => 'Silahkan isi jabatan pemilik risiko.',
        ];
    }
}
