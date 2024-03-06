<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class AuthenticateLibroAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $validaSecrets = explode(',', env('ACCEPTED_SECRET'));

        if(in_array($request->header('Authorization'),$validaSecrets)){

            return $next($request);
        }

        abort(Response::HTTP_UNAUTHORIZED);

    }
}
