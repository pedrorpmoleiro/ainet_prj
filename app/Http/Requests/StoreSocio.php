<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSocio extends FormRequest
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
            'name'=>'required|regex:/^([a-zA-Z]+\s)*[a-zA-Z]+$/',
            'email'=>'required|email|unique:users,email',
            'nome_informal'=>'required|max:40',
            'sexo'=>'required',
            'data_nascimento'=>'required|date_format:d/m/Y',
            'nif'=>'required|unique:users,nif|numeric|max:999999999',
            'telefone'=>'required|unique:users,telefone|regex:/^\+?\d{3}(?: ?\d+)*$/|max:20',
            'endereco'=>'required',
            'tipo_socio'=>'required',
            'file_foto'=>'nullable|image'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'O nome deve ser preeenchido',
            'name.regex'=>'O nome não deve conter números',
            'email.required'=>'O email deve ser preenchido',
            'email.email'=>'O formato do email não é válido',
            'email.unique'=>'Este email já se encontra registado',
            'nome_informal.required'=>'O nome deve ser preenchido',
            'nome_informal.max'=>'O nome não pode ser maior que 40 caracteres',
            'sexo.required'=>'O género tem que ser definido',
            'data_nascimento.required'=>'A data de nascimento deve ser preenchida',
            'data_nascimento.date'=>'O formato da data está inválido',
            'nif.required'=>'O NIF deve ser preenchido',
            'nif.unique'=>'Este NIF já se encontra registado',
            'nif.integer'=>'O NIF tem que ser um número inteiro',
            'telefone.required'=>'O número de telefone deve ser preenchido',
            'telefone.unique'=>'Este número de telefone já se encontra registado',
            'telefone.regex'=>'O formato número de telefone não é válido',
            'telefone.max'=>'O número de telefone não pode ter mais de 20 caracteres',
            'endereco.required'=>'O endereço deve ser preenchido',
            'tipo_socio.required'=>'O tipo de sócio tem que ser preenchido',
            'file_foto.image'=>'O ficheiro não é uma imagem ou é de um formato não suportado'
        ];
    }
}
