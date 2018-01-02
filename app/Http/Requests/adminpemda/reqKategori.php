<?php

namespace App\Http\Requests\adminpemda;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class reqKategori extends FormRequest
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
            //
            'nama_kategori' => 'required',
            'selera_risiko' => 'required|numeric|between:1,25',
        ];
    }

    public function messages()
    {
        return [
        'nama_kategori.required' => 'Silahkan pilih kategori.',
        'selera_risiko.required' => 'Silahkan isi nilai selera risiko.',
        ];
    }
}
