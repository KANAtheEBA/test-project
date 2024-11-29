<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RemovePoweredByHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  \Illuminate\Http\Request $request
     * @return  \symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next): Response
    {
        $response = $next($request);
        $response->headers->remove('X-Powered-By');
        return $response;
    }
}
