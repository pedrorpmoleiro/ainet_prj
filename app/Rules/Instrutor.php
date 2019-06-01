<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;

class Instrutor implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $socio = User::find($value);

        if (isset($socio) && isset($socio->instrutor)) {
            return $socio->instrutor == 1;
        }

        return false;
    }

    public function message()
    {
        return 'O sócio indicado não é um Instrutor';
    }
}
