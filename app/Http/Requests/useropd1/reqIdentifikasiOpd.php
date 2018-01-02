<?php

namespace App\Http\Requests\useropd1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class reqIdentifikasiOpd extends FormRequest
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
            'periode' => 'required',
            'risiko_id' => 'required',
            'uraian' => 'required',
            'sumber_risiko' => 'required',
            'kontrol' => 'required',
            'penyebab' => 'required',
            'dampak' => 'required',
            'pengendalian' => 'required',
            'sisa_risiko' => 'required',
        ];
    }

    public function messages()
    {
        return [
        'sasaran_id.required' => 'Silahkan pilih sasaran opd.',
        'periode.required' => 'Silahkan pilih periode opd.',
        'risiko_id.required' => 'Silahkan pilih risiko opd.',
        'uraian.required' => 'Silahkan isi uraian risiko opd.',
        'sumber_risiko.required' => 'Silahkan pilih sumber risiko opd.',
        'kontrol.required' => 'Silahkan pilih kontrol risiko opd.',
        'penyebab.required' => 'Silahkan isi penyebab risiko opd.',
        'dampak.required' => 'Silahkan isi dampak negatif risiko opd.',
        'pengendalian.required' => 'Silahkan isi pengendalian risiko opd.',
        'sisa_risiko.required' => 'Silahkan pilih sisa risiko opd.',
        ];
    }
}
