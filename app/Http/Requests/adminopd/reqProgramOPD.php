<?php

namespace App\Http\Requests\adminopd;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class reqProgramOPD extends FormRequest
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
            'sasaran_id' => 'required',
            'nama_program' => 'required',
        ];
    }

    public function messages()
    {
        return [
        'sasaran_id.required' => 'Silahkan pilih sasaran.',
        'nama_program.required' => 'Nama program harus diisi.',
        ];
    }
}
