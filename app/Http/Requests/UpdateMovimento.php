<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovimento extends FormRequest
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
            'data'=>'required',
            'hora_descolagem'=>'required',
            'hora_aterragem'=>'required',
            'num_diario'=>'required',
            'num_servico'=>'required',
            'num_aterragens'=>'required',
            'num_descolagens'=>'required',
            'num_pessoas'=>'required',
            'conta_horas_inicio'=>'required',
            'conta_horas_fim'=>'required',
            //'modo_pagamento'=>'required',
            'num_recibo'=>'required',
            //'tipo_instrucao'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'data.required'=>'A data é requerida',
            'hora_descolagem.required'=>'A hora decolagem é requerida',
            'hora_aterragem.required'=>'A hora aterragem é requerida',
            'num_diario.required'=>' Número de diario é requerido',
            'num_servico.required'=>'Número de servico é requerido',
            'num_aterragens.required'=>'Número de aterragens é requerido',
            'num_descolagens.required'=>'Número descolagens é requerido',
            'num_pessoas.required'=>'Número de pessoas é requerido ',
            'conta_horas_inicio.required'=>'As horas de inicio é requerida',
            'conta_horas_fim.required'=>'As horas de fim é requerida',
            //'modo_pagamento.required'=>'O modo do pagamento é requerido',
            'num_recibo.required'=>'Número de recibo é requerido'
            //'tipo_instrucao.required'=>'Tipo instrucao é requerido',
        ];
    }
}
