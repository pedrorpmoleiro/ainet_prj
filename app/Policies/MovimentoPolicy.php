<?php

namespace App\Policies;

use App\Movimento;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MovimentoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update (User $user, Movimento $movimento)
    {
        return !$movimento->confirmado && ($user->direcao || ($user->tipo_socio == 'P' && ($user->id == $movimento->piloto_id || $user->id == $movimento->instrutor_id)));
    }

    public function create (User $user)
    {
        return $user->direcao || $user->tipo_socio == 'P';
    }
}
