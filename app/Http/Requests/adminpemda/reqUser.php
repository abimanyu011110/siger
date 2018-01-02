<?php

namespace App\Http\Requests\adminpemda;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class reqUser extends FormRequest
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
            'nama' => 'required',
            'username' => 'required|unique:tbl_user',
            'role_id' => 'required',
            'password' => 'required|min:5|confirmed',
        ];
    }

    public function messages()
    {
        return [
        'nama.required' => 'isi nama',
        'username.required' => 'isi username',
        'role_id.required' => 'pilih role',
        'password.required' => 'isi password',
        ];
    }
}
