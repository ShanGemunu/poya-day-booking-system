<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventAuthUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ********** 

        // auth('sanctum')->user()      
        // returns only User Model instance from users table if Bearer token send in proper way, otherwise always returns null

        // **********
        if (auth('sanctum')->user())
            return response()->json([
                'error' => 'access forbidden'
            ], 403);
            
        return $next($request);
    }
}
