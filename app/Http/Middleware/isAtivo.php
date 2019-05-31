<?php

namespace App\Http\Middleware;

use Closure;
use \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class isAtivo
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->ativo == 1 && $request->user()->password_inicial == 0) {

            return $next($request);
        }

        throw new AccessDeniedHttpException('Unauthorized.');
    }
}
