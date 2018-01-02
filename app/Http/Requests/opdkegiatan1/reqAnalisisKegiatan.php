<?php

namespace App\Http\Requests\opdkegiatan1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class reqAnalisisKegiatan extends FormRequest
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
            'opd_id' => 'required',
            'kegiatan_id' => 'required',
            'risiko_id' => 'required',
            'pemda_id' => 'required|default:1',
            'periode' => 'required',
            'kemungkinan_id' => 'required',
            'dampak_id' => 'required',
            'tingkat_risiko' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'kegiatan_id.required' => 'Silahkan pilih kegiatan opd.',
            'risiko_id.required' => 'Silahkan pilih pernyataan risiko.',
            'periode.required' => 'Silahkan pilih periode risiko.',
            'kemungkinan_id.required' => 'Silahkan pilih tingkat kemungkinan risiko.',
            'dampak_id.required' => 'Silahkan pilih tingkat dampak risiko.',
        ];
    }
}
