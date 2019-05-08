<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movimento extends Model
{
    use SoftDeletes;

    protected $fillable=['data','aeronave','hora_descolagem','hora_aterragem','num_diario','num_servicio','piloto_id','num_certificado_piloto'
,'validade_certificado_piloto','classe_certificado_piloto','natureza','aerodromo_partida','aerodromo_chegada','num_aterragens','num_descolagens'
,'num_pessoas','conta_horas_inicio','conta_horas_fim','modo_pagamento','num_recibo','tipo_instrucao',
'instrutor_id','num_licenca_instrutor','validade_licenca_instrutor','tipo_licenca_instrutor','num_certificado_instrutor','validade_certificado_instrutor'
,'classe_certificado_instrutor'];
}
