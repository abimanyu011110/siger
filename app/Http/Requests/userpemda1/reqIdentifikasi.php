<?php

namespace App\Http\Requests\userpemda1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class reqIdentifikasi extends FormRequest
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
        'sasaran_id.required' => 'Silahkan pilih sasaran pemerintah daerah.',
        'periode.required' => 'Silahkan pilih periode risiko.',
        'risiko_id.required' => 'Silahkan pilih risiko.',
        'uraian.required' => 'Silahkan isi uraian risiko.',
        'sumber_risiko.required' => 'Silahkan pilih sumber risiko.',
        'kontrol.required' => 'Silahkan pilih kontrol yang ada.',
        'penyebab.required' => 'Silahkan isi penyebab risiko.',
        'dampak.required' => 'Silahkan isi dampak negatif risiko.',
        'pengendalian.required' => 'Silahkan isi pegendalian yang ada pada risiko.',
        'sisa_risiko.required' => 'Silahkan pilih sisa risiko.',
        ];
    }
}
