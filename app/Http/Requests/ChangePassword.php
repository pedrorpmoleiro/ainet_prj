<?php

namespace App\Http\Requests;

use App\Rules\PasswordMatch;
use Illuminate\Foundation\Http\FormRequest;

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
            'password'=>'required|regex:/^\S*(?=\S{8,})\S*$/|different:old_password|same:password_confirmation',
            'password_confirmation'=>'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'old_password.required'=>'Este campo é obrigatório',
            'password.required'=>'Este campo é obrigatório',
            'password.regex'=>'A senha tem que ter 8 caracteres no minimo',
            'password.different'=>'A nova senha deve ser diferente da senha antiga',
            'password_confirmation.required'=>'Este campo é obrigatório',
            'password.same'=>'Esta senha não é igual à do campo "Nova Senha"',
            'password_confirmation.same'=>'Esta senha não é igual à do campo "Nova Senha"'
        ];
    }
}
