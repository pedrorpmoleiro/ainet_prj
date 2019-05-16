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

    public function update (User $user, User $socio) {
        return ($user->direcao == 1) || $user->id == $socio->id;
    }

    public  function licenca (User $user, User $piloto) {
        return ($user->direcao == 1) || $user->id == $piloto->id;
    }
}
