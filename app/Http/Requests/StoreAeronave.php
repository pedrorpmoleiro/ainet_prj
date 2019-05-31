<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAeronave extends FormRequest
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
            'matricula' => ['required', "unique:aeronaves,matricula", 'max:8'],
            'marca' => ['required', 'max:40'],
            'num_lugares' => ['integer', 'required', 'min:1'],
            'conta_horas' => ['integer', 'required', 'min:1'],
            'preco_hora' => ['required', 'numeric', 'min:1'],
            'modelo' => ['required', 'max:40'],
            'tempos.*' => ['required', 'integer', 'min:1'],
            'precos.*' => ['required', 'numeric', 'min:1']
        ];
    }

    public function messages()
    {
        return [
            'matricula.required' => 'A matricula deve ser preenchida',
            'matricula.unique' => 'Esta matricula já se encontra registada',
            'matricula.max' => 'A matricula não pode ter mais de 8 caracteres',
            'marca.required' => ' A marca deve ser preenchida',
            'marca.max' => 'A marca não pode ter mais de 40 caracteres',
            'num_lugares.required' => 'Os lugares deve ser preenchidos',
            'num_lugares.integer' => 'O número de lugares deve ser um número inteiro',
            'num_lugares.min' => 'O número de lugares deve ser um número positivo',
            'conta_horas.required' => 'As horas devem ser preenchidas',
            'conta_horas.integer' => 'O valor conta horas deve ser um número inteiro',
            'conta_horas.min' => 'O valor conta horas deve ser um número positivo',
            'preco_hora.required' => 'O preco deve ser preenchido',
            'preco_hora.numeric' => 'O preco deve ser um número',
            'preco_hora.min' => 'O preco deve ser um número positivo',
            'modelo.required' => 'O modelo deve ser preenchido',
            'modelo.max' => 'O modelo não pode ter mais de 40 caracteres',
            'tempos.*.required' => 'Este campo é obrigatório',
            'tempos.*.integer' => 'Deve ser um numero inteiro',
            'tempos.*.min' => 'Deve ser um número positivo',
            'precos.*.required' => 'Este campo é obrigatório',
            'precos.*.numeric' => 'Deve ser um numero inteiro',
            'precos.*.min' => 'Deve ser um número positivo'
        ];
    }
}
