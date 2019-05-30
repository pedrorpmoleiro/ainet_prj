<?php

namespace App\Http\Requests;

use App\Rules\Instrutor;
use App\Rules\Piloto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $rules = [
            'data'=>['required', 'date_format:Y-m-d'],
            'aeronave'=>['required', 'exists:aeronaves,matricula'],
            'aerodromo_partida'=>['required', 'exists:aerodromos,code'],
            'aerodromo_chegada'=>['required', 'exists:aerodromos,code'],
            'hora_descolagem'=>['required', 'date_format:H:i:s'],
            'hora_aterragem'=>['required', 'date_format:H:i:s'],
            'num_diario'=>['required', 'integer', 'min:1'],
            'num_servico'=>['required', 'integer', 'min:1'],
            'num_aterragens'=>['required', 'integer', 'min:1'],
            'num_descolagens'=>['required', 'integer', 'min:1'],
            'num_pessoas'=>['required', 'integer', 'min:1'],
            'conta_horas_inicio'=>['required', 'integer', 'min:1'],
            'conta_horas_fim'=>['required', 'integer', 'gt:conta_horas_inicio', 'min:1'],
            'modo_pagamento'=>['required', Rule::in(['N', 'M', 'T', 'P'])],
            'num_recibo'=>['required', 'max:20'],
            'natureza'=>['required', Rule::in(['T', 'I', 'E'])],
            'observacoes'=>['nullable'],
            'justificacao_conflito'=>['nullable'],
            'piloto_id'=>['required', 'exists:users,id', new Piloto],
            'tempo_voo'=>['required', 'integer', 'min:1'],
            'preco_voo'=>['required', 'numeric', 'min:1']
        ];

        if ($this->request->get('natureza') == 'I') {
            $rules['tipo_instrucao'] = ['required', Rule::in(['D', 'S'])];
            $rules['instrutor_id'] = ['required', 'exists:users,id', new Instrutor];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'data.required'=>'A data é requerida',
            'aerodromo_partida.required'=>'O aerodromo de partida é necessario',
            'aerodromo_chegada.required'=>'O aerodromo de chegada    é necessario',
            'aeronave.required'=>'A aeronave é requerida',
            'hora_descolagem.required'=>'A hora decolagem é requerida',
            'hora_aterragem.required'=>'A hora aterragem é requerida',
            'num_diario.required'=>' Número de diario é requerido',
            'num_servico.required'=>'Número de servico é requerido',
            'num_aterragens.required'=>'Número de aterragens é requerido',
            'num_descolagens.required'=>'Número descolagens é requerido',
            'num_pessoas.required'=>'Número de pessoas é requerido ',
            'conta_horas_inicio.required'=>'As horas de inicio é requerida',
            'conta_horas_fim.required'=>'As horas de fim é requerida',
            'modo_pagamento.required'=>'O modo do pagamento é requerido',
            'num_recibo.required'=>'Número de recibo é requerido',
            'instrutor_id.numeric'=>'Numero instrutor errado',
            'natureza.required'=>'Natureza é requereida',
            'conta_horas_fim.gt'=>'A conta hora fim deve ser maior do que Conta hora inicio',
            'conta_horas_inicio.numeric'=>'A conta hora inicio dever ser um numero',
            'conta_horas_fim.numeric'=>'A conta hora fim dever ser um numero',
            'num_diario.numeric'=>'Número de diario deve ser un número',
            'num_servico.numeric'=>'Número de servico deve ser un número',
            'num_aterragens.numeric'=>'Número de aterragens deve ser un número',
            'num_descolagens.numeric'=>'Número de descolagens deve ser un número',
            'num_pessoas.numeric'=>'Número de pessoas deve ser un número',
            'num_recibo.numeric'=>'Número de recibo deve ser un número'
        ];
    }
}
