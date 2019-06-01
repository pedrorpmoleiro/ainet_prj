<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateSocio extends FormRequest
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
        $id = (int)$this->route()->parameters()['socio']->id;

        $rules = [
            'name' => ['required', 'regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/'],
            'num_socio' => ['required', 'integer', 'min:1', "unique:users,num_socio,$id"],
            'sexo' => ['required', Rule::in(['M', 'F'])],
            'email' => ['required', 'email', "unique:users,email,$id"],
            'nome_informal' => ['required', 'max:40'],
            'data_nascimento' => ['required', 'date_format:Y-m-d', 'before:today'],
            'nif' => ['nullable', 'integer', 'max:999999999'],
            'telefone' => ['nullable', 'max:20'],
            'endereco' => ['nullable'],
            'tipo_socio' => ['required', Rule::in(['P', 'NP', 'A'])],
            'file_foto' => ['nullable', 'image'],
            'quota_paga' => ['required', Rule::in(['1', '0'])],
            'ativo' => ['required', Rule::in(['1', '0'])],
            'direcao' => ['required', Rule::in(['1', '0'])]
        ];

        if ($this->request->get('tipo_socio') == 'P' || Auth::user()->direcao) {
            $rules['instrutor'] = ['nullable', Rule::in(['1', '0'])];
            $rules['licenca_confirmada'] = ['nullable', Rule::in(['1', '0'])];
            $rules['certificado_confirmado'] = ['nullable', Rule::in(['1', '0'])];
            $rules['num_licenca'] = ['nullable', 'max:30'];
            $rules['tipo_licenca'] = ['nullable', 'exists:tipos_licencas,code'];
            $rules['validade_licenca'] = ['nullable', 'date_format:Y-m-d'];
            $rules['num_certificado'] = ['nullable', 'max:30'];
            $rules['classe_certificado'] = ['nullable', 'exists:classes_certificados,code'];
            $rules['validade_certificado'] = ['nullable', 'date_format:Y-m-d'];
            $rules['file_licenca'] = ['nullable', 'file', 'mimes:pdf'];
            $rules['file_certificado'] = ['nullable', 'file', 'mimes:pdf'];
            $rules['aluno'] = ['required', Rule::in(['1', '0'])];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome deve ser preeenchido',
            'name.regex' => 'O nome não deve conter números',
            'num_socio.required' => 'O número de sócio é obrigatório',
            'num_socio.integer' => 'Tem que ser um número inteiro',
            'num_socio.min' => 'Não pode ser um número negativo',
            'num_socio.unique' => 'Este número já se encontra registado',
            'email.required' => 'O email deve ser preenchido',
            'email.email' => 'O formato do email não é válido',
            'email.unique' => 'Este email já se encontra registado',
            'nome_informal.required' => 'O nome deve ser preenchido',
            'nome_informal.max' => 'O campo não deve conter mais do que 40 caracteres',
            'sexo.required' => 'O género tem que ser definido',
            'sexo.in' => 'Género inválido',
            'data_nascimento.required' => 'A data de nascimento deve ser preenchida',
            'data_nascimento.date_format' => 'O formato da data está inválido',
            'data_nascimento.before' => 'A data de nascimento não pode ser superior à data atual',
            'nif.integer' => 'O NIF tem que ser um número inteiro',
            'nif.max' => 'Um NIF não pode ter mais de 9 números',
            'telefone.regex' => 'O formato número de telefone não é válido',
            'telefone.max' => 'O número de telefone não pode ter mais de 20 caracteres',
            'file_foto.image' => 'O ficheiro não é uma imagem ou é de um formato não suportado',
            'tipo_socio.required' => 'O tipo de sócio tem que ser preenchido',
            'tipo_socio.in' => 'O tipo de sócio é inválido',
            'quota_paga.required' => 'O valor tem de ser preenchido',
            'quota_paga.in' => 'O valor é inválido',
            'ativo.required' => 'O valor tem de ser preenchido',
            'ativo.in' => 'O valor é inválido',
            'direcao.required' => 'O valor tem de ser preenchido',
            'direcao.in' => 'O valor é inválido',
            'instrutor.in' => 'O valor é inválido',
            'licenca_confirmada.in' => 'O valor é inválido',
            'certificado_confirmado.in' => 'O valor é inválido',
            'aluno.required' => 'O valor tem de ser preenchido',
            'aluno.in' => 'O valor é inválido',
            'num_licenca.max' => 'O número de licença não pode ter mais de 30 caracteres',
            'tipo_licenca.exists' => 'Tipo de licença inválida',
            'validade_licenca.date_format' => 'O formato da data está inválido',
            'validade_certificado.date_format' => 'O formato da data está inválido',
            'num_certificado.max' => 'O número de certificado não pode ter mais de 30 caracteres',
            'classe_certificado.exists' => 'Classe de certificado inválido',
            'file_licenca.mimes' => 'Só é possível carregar um ficheio PDF',
            'file_certificado.mimes' => 'Só é possível carregar um ficheio PDF'
        ];
    }
}
