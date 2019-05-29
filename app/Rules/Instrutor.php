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
        $socio = User::findOrFail($value);

        return $socio->instrutor;
    }

    public function message()
    {
        return 'O sócio indicado não é um Instrutor';
    }
}
