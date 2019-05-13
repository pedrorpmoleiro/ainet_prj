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
        return [
            'matricula'=>'required',
            'marca'=> 'required',
            'num_lugares' => 'integer|required',
            'conta_horas'=> 'integer|required',
            'preco_hora'=> 'required|numeric',
            'modelo' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'matricula.required'=>'A matricula deve ser preenchida',
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
