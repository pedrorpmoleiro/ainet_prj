<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

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
        $id = (int) $this->route()->parameters()['socio']->id;

        $queryLicenca = DB::select('select code from tipos_licencas');
        $listLicenca = [];
        foreach ($queryLicenca as $line) {
            $listLicenca[] = $line->code;
        }

        $queryCertificado = DB::select('select code from classes_certificados');
        $listCertificado = [];
        foreach ($queryCertificado as $line) {
            $listCertificado[] = $line->code;
        }

        return [
            'name'=>'required|regex:/^([a-zA-Z]+\s)*[a-zA-Z]+$/',
            'email'=>"required|email|unique:users,email,$id,id",
            'nome_informal'=>'required|max:40',
            'sexo'=>'nullable',
            'data_nascimento'=>'required|date_format:Y-m-d',
            'nif'=> "nullable|numeric|max:999999999|unique:users,nif,$id,id",
            'telefone'=>"nullable|max:20|regex:/^\+?\d{3}(?: ?\d+)*$/|unique:users,telefone,$id,id",
            'endereco'=>'nullable',
            'tipo_socio'=>'nullable',
            'file_foto'=>'nullable|image',
            'num_licenca'=>'nullable|max:30',
            'tipo_licenca' =>['nullable', Rule::in($listLicenca)],
            'validade_licenca'=>'nullable|date_format:Y-m-d',
            'num_certificado'=>'nullable|max:30',
            'classe_certificado'=>['nullable', Rule::in($listCertificado)],
            'validade_certificado'=>'nullable|date_format:Y-m-d',
            'file_licenca' => 'nullable|file|mimes:pdf',
            'file_certificado' => 'nullable|file|mimes:pdf'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'O nome deve ser preeenchido',
            'name.regex'=>'O nome não deve conter números',
            'email.required'=>'O email deve ser preenchido',
            'email.email'=>'O formato do email não é válido',
            'nome_informal.required'=>'O nome deve ser preenchido',
            'nome_informal.max'=>'O campo não deve conter mais do que 40 caracteres',
            'data_nascimento.required'=>'A data de nascimento deve ser preenchida',
            'data_nascimento.date'=>'O formato da data está inválido',
            'nif.numeric'=>'O NIF tem que ser um número inteiro',
            'nif.max'=>'Um NIF não pode ter mais de 9 números',
            'telefone.regex'=>'O formato número de telefone não é válido',
            'telefone.max'=>'O número de telefone não pode ter mais de 20 caracteres',
            'file_foto.image'=>'O ficheiro não é uma imagem ou é de um formato não suportado'
        ];
    }
}
