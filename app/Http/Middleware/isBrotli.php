<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isBrotli
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($this->isWasmFileRoute($request)){
           return $next($request)->header('Content-Encoding', 'br');
        }
        return $next($request);
    }

    public function isWasmFileRoute($request){
        $path = $request->path();

        return \Str::startsWith($path, 'Build2/') && \Str::endsWith($path, '.br');
    }
}
