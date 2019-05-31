<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Movimento extends Model
{


    protected $fillable = ['piloto_id', 'data', 'hora_descolagem', 'hora_aterragem', 'num_diario', 'num_servico', 'num_certificado_piloto'
        , 'validade_certificado_piloto', 'classe_certificado_piloto', 'natureza', 'aerodromo_partida', 'aerodromo_chegada', 'num_aterragens', 'num_descolagens'
        , 'num_pessoas', 'conta_horas_inicio', 'conta_horas_fim', 'modo_pagamento', 'num_recibo', 'tipo_instrucao', 'instrutor_id', 'num_licenca_instrutor', 'validade_licenca_instrutor', 'tipo_licenca_instrutor', 'num_certificado_instrutor', 'validade_certificado_instrutor'
        , 'classe_certificado_instrutor', 'preco_voo', 'tempo_voo', 'confirmado', 'num_licenca_piloto', 'validade_licenca_piloto', 'tipo_licenca_piloto', 'aeronave', 'observacoes', 'tipo_conflito'
        , 'justificacao_conflito'];

    public function piloto()
    {
        return $this->belongsTo('App\User');
    }

    public function instrutor()
    {
        return $this->belongsTo('App\User');
    }
    
    public static function toString($natureza)
    {
        switch ($natureza) {
            case "T":
                return "Treino";
                break;
            case "I":
                return "Instrucao";
                break;
            case "E":
                return "Especial";
                break;
        }
    }
}
