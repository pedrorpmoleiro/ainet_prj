<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Movimento extends Model
{
    

    protected $fillable=['data','aeronave','hora_descolagem','hora_aterragem','num_diario','num_servico','piloto_id','num_certificado_piloto'
,'validade_certificado_piloto','classe_certificado_piloto','natureza','aerodromo_partida','aerodromo_chegada','num_aterragens','num_descolagens'
,'num_pessoas','conta_horas_inicio','conta_horas_fim','modo_pagamento','num_recibo','tipo_instrucao',
'instrutor_id','num_licenca_instrutor','validade_licenca_instrutor','tipo_licenca_instrutor','num_certificado_instrutor','validade_certificado_instrutor'
,'classe_certificado_instrutor','preco_voo','tempo_voo','confirmado','num_licenca_piloto','validade_licenca_piloto','tipo_licenca_piloto'];

    public function pilotos(){
        return $this->belongsToMany('App\User','movimentos','piloto_id');
    }
}
