<?php

namespace App\Http\Requests\adminpemda;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class reqVisi extends FormRequest
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
            'nama_visi' => 'required',
        ];
    }

    public function messages()
    {
        return [
        'nama_visi.required' => 'Silahkan isi visi pemerintah daerah.',
        ];
    }
}
