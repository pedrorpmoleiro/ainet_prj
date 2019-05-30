<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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

    public function canUpdate (User $userLogado, User $socio) {
        return $userLogado->direcao || $userLogado->id == $socio->id;
    }

    public  function verLicenca (User $userLogado, User $user) {
        return $user->tipo_socio == 'P' && ($userLogado->direcao || $userLogado->id == $user->id);
    }
}
