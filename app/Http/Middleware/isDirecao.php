<?php

namespace App\Http\Middleware;

use Closure;
use \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class isDirecao
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->direcao) {

            return $next($request);
        }

        throw new AccessDeniedHttpException('Unauthorized.');
    }
}
