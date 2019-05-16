<?php

namespace App\Http\Requests;

use App\Rules\PasswordMatch;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChangePassword extends FormRequest
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
            'old_password'=>['required', new PasswordMatch],
            'new_password'=>'required|regex:/^\S*(?=\S{8,})\S*$/|different:old_password',
            'new_password_confirm'=>'required|same:new_password'
        ];
    }

    public function messages()
    {
        return [
            'old_password.required'=>'Este campo é obrigatório',
            'new_password.required'=>'Este campo é obrigatório',
            'new_password.regex'=>'A senha tem que ter 8 caracteres no minimo',
            'new_password.different'=>'A nova senha deve ser diferente da senha antiga',
            'new_password_confirm.required'=>'Este campo é obrigatório',
            'new_password_confirm.same'=>'Esta senha não é igual à do campo "Nova Senha"'
        ];
    }
}
