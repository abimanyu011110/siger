<?php

namespace App\Http\Requests\adminpemda;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class reqBaganrisiko extends FormRequest
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
            'kategori_id' => 'required',
            'proses_id' => 'required',
            'nama_risiko' => 'required',
        ];
    }

    public function messages()
    {
        return [
        'kategori_id.required' => 'Silahkan pilih kategori.',
        'proses_id.required' => 'Silahkan pilih proses.',
        'nama_risiko.required' => 'Silahkan isi nama risiko.',
        ];
    }
}
