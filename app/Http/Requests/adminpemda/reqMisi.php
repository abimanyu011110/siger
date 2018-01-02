<?php

namespace App\Http\Requests\adminpemda;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class reqMisi extends FormRequest
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
            'visi_id' => 'required',
            'nama_misi' => 'required',
        ];
    }

    public function messages()
    {
        return [
        'visi_id.required' => 'Silahkan pilih visi.',
        'nama_misi.required' => 'Nama misi harus diisi.',
        ];
    }
}
