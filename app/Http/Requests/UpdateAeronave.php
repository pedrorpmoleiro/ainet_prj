<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAeronave extends FormRequest
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
        $matricula = (string) $this->route()->parameters()['aeronave']->matricula;

        return [
            'matricula'=>['required', "unique:aeronaves,matricula,$matricula,matricula", 'max:8'],
            'marca'=> ['required', 'max:40'],
            'num_lugares' => ['integer', 'required', 'min:1'],
            'conta_horas'=> ['integer', 'required', 'min:0'],
            'preco_hora'=> ['required', 'numeric', 'min:0'],
            'modelo' => ['required', 'max:40'],
            'tempos.*' => ['required', 'integer', 'min:1'],
            'precos.*' => ['required', 'numeric', 'min:1']
        ];
    }

    public function messages()
    {
        return [
            'matricula.required'=>'A matricula deve ser preenchida',
            'matricula.unique'=>'Esta matricula já se encontra registada',
            'marca.required'=> ' A marca deve ser preenchida',
            'num_lugares.required' => 'Os lugares deve ser preenchidos',
            'conta_horas.required'=> 'As horas devem ser preenchidas',
            'preco_hora.required'=> 'O preco deve ser preenchido',
            'modelo.required' => 'O modelo deve ser preenchido',
            'num_lugares.integer' => 'Deve ser um numero inteiro',
            'conta_horas.integer'=> 'Deve ser um numero inteiro',
            'preco_hora.numeric'=> 'Deve ser um valor numerico decimal'
        ];
    }
}
