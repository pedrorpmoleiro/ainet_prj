<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'num_socio', 'nome_informal', 'sexo', 'data_nascimento', 'nif', 'telefone',
        'endereco', 'tipo_socio', 'quota_paga', 'ativo', 'direcao', 'aluno', 'validade_licenca', 'num_licenca',
        'tipo_licenca', 'instrutor', 'licenca_confirmada', 'certificado_confirmado', 'num_certificado',
        'classe_certificado', 'validade_certificado', 'file_licenca', 'file_certificado', 'foto_url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function aeronaves()
    {
        return $this->belongsToMany('App\Aeronave', 'aeronaves_pilotos', 'piloto_id', 'matricula');
    }

    public function movimentos()
    {
        return $this->hasMany('App\Movimento');
    }

}
