<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;

class TokenControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $header = $request->header('Authorization');

        $response = Http::withHeaders([
            'Authorization' => $header
        ])->get('http://webapp:8000/api/check-token');

        if(strlen($response->body()) < 2) {
            return $next($request);
        }
    }
}
