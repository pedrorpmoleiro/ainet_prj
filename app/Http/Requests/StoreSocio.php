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
            'num_socio'=>'required|numeric|min:0|unique:users,num_socio',
            'email'=>'required|email|unique:users,email',
            'nome_informal'=>'required|max:40',
            'sexo'=>['required', Rule::in(['M', 'F'])],
            'data_nascimento'=>'required|date_format:Y-m-d|before:today',
            'nif'=>'required|numeric|max:999999999',
            'telefone'=>'required|regex:/^\+?\d{3}(?: ?\d+)*$/|max:20',
            'endereco'=>'required',
            'tipo_socio'=>['required', Rule::in(['P', 'NP', 'A'])],
            'file_foto'=>'nullable|image',
            'quota_paga'=>['required', Rule::in(['1', '0'])],
            'ativo'=>['required', Rule::in(['1', '0'])],
            'direcao'=>['required', Rule::in(['1', '0'])],
            'instrutor'=>['required', Rule::in(['1', '0']),'different:aluno'],
            'licenca_confirmada'=>['required', Rule::in(['1', '0'])],
            'certificado_confirmado'=>['required', Rule::in(['1', '0'])],
            'aluno'=>['required', Rule::in(['1', '0']), 'different:instrutor']
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'O nome deve ser preeenchido',
            'name.regex'=>'O nome não deve conter números',
            'num_socio.required'=>'O número de sócio é obrigatório',
            'num_socio.numeric'=>'Tem que ser um número',
            'num_socio.min'=>'Não pode ser um número negativo',
            'num_socio.unique'=>'Este número já se encontra registado',
            'email.required'=>'O email deve ser preenchido',
            'email.email'=>'O formato do email não é válido',
            'email.unique'=>'Este email já se encontra registado',
            'nome_informal.required'=>'O nome deve ser preenchido',
            'nome_informal.max'=>'O nome não pode ser maior que 40 caracteres',
            'sexo.required'=>'O género tem que ser definido',
            'sexo.in'=>'Género inválido',
            'data_nascimento.required'=>'A data de nascimento deve ser preenchida',
            'data_nascimento.date'=>'O formato da data está inválido',
            'data_nascimento.before'=>'A data de nascimento não pode ser superior à data atual',
            'nif.required'=>'O NIF deve ser preenchido',
            'nif.integer'=>'O NIF tem que ser um número inteiro',
            'telefone.required'=>'O número de telefone deve ser preenchido',
            'telefone.regex'=>'O formato número de telefone não é válido',
            'telefone.max'=>'O número de telefone não pode ter mais de 20 caracteres',
            'endereco.required'=>'O endereço deve ser preenchido',
            'tipo_socio.required'=>'O tipo de sócio tem que ser preenchido',
            'tipo_socio.in'=>'O tipo de sócio é inválido',
            'file_foto.image'=>'O ficheiro não é uma imagem ou é de um formato não suportado',
            'quota_paga.required'=>'O valor tem de ser preenchido',
            'quota_paga.in'=>'O valor é inválido',
            'ativo.required'=>'O valor tem de ser preenchido',
            'ativo.in'=>'O valor é inválido',
            'direcao.required'=>'O valor tem de ser preenchido',
            'direcao.in'=>'O valor é inválido',
            'instrutor.required'=>'O valor tem de ser preenchido',
            'instrutor.in'=>'O valor é inválido',
            'licenca_confirmada.required'=>'O valor tem de ser preenchido',
            'licenca_confirmada.in'=>'O valor é inválido',
            'certificado_confirmado.required'=>'O valor tem de ser preenchido',
            'certificado_confirmado.in'=>'O valor é inválido',
            'aluno.required'=>'O valor tem de ser preenchido',
            'aluno.in'=>'O valor é inválido',
            'aluno.different'=>'Não é possível ser instrutor e aluno ao mesmo tempo',
            'instrutor.different'=>'Não é possível ser instrutor e aluno ao mesmo tempo'
        ];
    }
}
