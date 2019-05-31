<?php

namespace App\Http\Requests;

use App\Rules\Instrutor;
use App\Rules\Piloto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMovimento extends FormRequest
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
            'data' => ['required', 'date_format:Y-m-d'],
            'aeronave' => ['required', 'exists:aeronaves,matricula'],
            'aerodromo_partida' => ['required', 'exists:aerodromos,code'],
            'aerodromo_chegada' => ['required', 'exists:aerodromos,code'],
            'hora_descolagem' => ['required', 'date_format:H:i'],
            'hora_aterragem' => ['required', 'date_format:H:i'],
            'num_diario' => ['required', 'integer', 'min:1'],
            'num_servico' => ['required', 'integer', 'min:1'],
            'num_aterragens' => ['required', 'integer', 'min:1'],
            'num_descolagens' => ['required', 'integer', 'min:1'],
            'num_pessoas' => ['required', 'integer', 'min:1'],
            'conta_horas_inicio' => ['required', 'integer', 'min:1'],
            'conta_horas_fim' => ['required', 'integer', 'gt:conta_horas_inicio', 'min:1'],
            'modo_pagamento' => ['required', Rule::in(['N', 'M', 'T', 'P'])],
            'num_recibo' => ['required', 'max:20'],
            'natureza' => ['required', Rule::in(['T', 'I', 'E'])],
            'observacoes' => ['nullable'],
            'justificacao_conflito' => ['nullable'],
            'piloto_id' => ['required', 'integer','exists:users,id', new Piloto],
            'tempo_voo' => ['required', 'integer', 'min:1'],
            'preco_voo' => ['required', 'numeric', 'min:1']
        ];

        if ($this->request->get('natureza') == 'I') {
            $rules['tipo_instrucao'] = ['required', Rule::in(['D', 'S'])];
            $rules['instrutor_id'] = ['required', 'integer', 'exists:users,id', new Instrutor];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'data.required' => 'A data é requerida',
            'data.date_format' => 'O formato da data está inválido',
            'aerodromo_partida.required' => 'O aerodromo de partida é necessario',
            'aerodromo_partida.exists' => 'O aerodromo de partida não é válido',
            'aerodromo_chegada.required' => 'O aerodromo de chegada    é necessario',
            'aerodromo_chegada.exists' => 'O aerodromo de chegada não é válido',
            'aeronave.required' => 'A aeronave é requerida',
            'aeronave.exists' => 'A aeronave não é válido',
            'hora_descolagem.required' => 'A hora decolagem é requerida',
            'hora_descolagem.date_format' => 'O formato da hora está inválido',
            'hora_aterragem.required' => 'A hora aterragem é requerida',
            'hora_aterragem.date_format' => 'O formato da hora está inválido',
            'num_diario.required' => 'Número de diario é requerido',
            'num_diario.integer' => 'Número de diario tem de ser um número inteiro',
            'num_diario.min' => 'Número de diario tem de ser um número positivo',
            'num_servico.required' => 'Número de serviço é requerido',
            'num_servico.integer' => 'Número de serviço tem de ser um número inteiro',
            'num_servico.min' => 'Número de serviço tem de ser um número positivo',
            'num_aterragens.required' => 'Número de aterragens é requerido',
            'num_aterragens.integer' => 'Número de aterragens tem de ser um número inteiro',
            'num_aterragens.min' => 'Número de aterragens tem de ser um número positivo',
            'num_descolagens.required' => 'Número de descolagens é requerido',
            'num_descolagens.integer' => 'Número de descolagens tem de ser um número inteiro',
            'num_descolagens.min' => 'Número de descolagens tem de ser um número positivo',
            'num_pessoas.required' => 'Número de pessoas é requerido ',
            'num_pessoas.integer' => 'Número de pessoas tem de ser um número inteiro',
            'num_pessoas.min' => 'Número de pessoas tem de ser um número positivo',
            'conta_horas_inicio.required' => 'O conta horas de inicio é requerida',
            'conta_horas_inicio.integer' => 'O conta horas de inicio tem de ser um número inteiro',
            'conta_horas_inicio.min' => 'O conta horas de inicio tem de ser um número positivo',
            'conta_horas_fim.required' => 'O conta horas de fim é requerida',
            'conta_horas_fim.integer' => 'O conta horas de fim tem de ser um número inteiro',
            'conta_horas_fim.min' => 'O conta horas de fim tem de ser um número positivo',
            'conta_horas_fim.gt' => 'O conta horas de fim tem de ser maior que o valor do conta horas inicio',
            'modo_pagamento.required' => 'O modo do pagamento é requerido',
            'modo_pagamento.in' => 'O valor não é válido',
            'num_recibo.required' => 'Número de recibo é requerido',
            'num_recibo.max' => 'Número de recibo não pode ter mais de 20 caracteres',
            'natureza.required' => 'Natureza é requereida',
            'natureza.in' => 'O valor não é válido',
            'piloto_id.required' => 'O campo é obrigatório',
            'piloto_id.integer' => 'Deve ser um valor inteiro',
            'piloto_id.exists' => 'O piloto selecionado não existe',
            'tempo_voo.required' => 'O campo é obrigatório',
            'tempo_voo.integer' => 'Deve ser um valor inteiro',
            'tempo_voo.min' => 'Deve ser um valor positivo',
            'preco_voo.required' => 'O campo é obrigatório',
            'preco_voo.numeric' => 'Deve ser um valor numérico',
            'preco_voo.min' => 'Deve ser um valor positivo',
            'instrutor_id.required' => 'O campo é obrigatório',
            'instrutor_id.integer' => 'Deve ser um valor inteiro',
            'instrutor_id.exists' => 'O instrutor selecionado não existe',
            'tipo_instrucao.required' => 'O campo é obrigatório',
            'tipo_instrucao.in' => 'O valor é inválido'
        ];
    }
}
