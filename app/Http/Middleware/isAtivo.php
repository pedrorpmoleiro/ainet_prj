<?php

namespace App\Http\Middleware;

use Closure;
use \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class isAtivo
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->ativo) {

            return $next($request);
        }

        throw new AccessDeniedHttpException('Unauthorized.');
    }
}
