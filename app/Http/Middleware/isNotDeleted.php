<?php

namespace App\Http\Middleware;

use Closure;
use \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class isNotDeleted
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->deleted_at == '') {

            return $next($request);
        }

        throw new AccessDeniedHttpException('Unauthorized.');
    }
}
