<?php

namespace App\Http\Middleware;

use Closure;

class isPasswordInicial
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && !$request->user()->password_inicial) {
            return $next($request);
        } else {
            return redirect()->action('UserController@alterarPassword');
        }
    }
}
