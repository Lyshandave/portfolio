<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Security Headers
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        
        $csp = "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://fonts.googleapis.com; font-src 'self' data: https://cdnjs.cloudflare.com https://fonts.gstatic.com; img-src 'self' data: https:; connect-src 'self' https://en.wikipedia.org;";
        if (app()->environment('local')) {
            $viteOrigins = implode(' ', [
                'http://localhost:5173',
                'http://127.0.0.1:5173',
                'ws://localhost:5173',
                'ws://127.0.0.1:5173',
                'http://localhost:5174',
                'http://127.0.0.1:5174',
                'ws://localhost:5174',
                'ws://127.0.0.1:5174',
                'http://localhost:5175',
                'http://127.0.0.1:5175',
                'ws://localhost:5175',
                'ws://127.0.0.1:5175',
            ]);

            $csp = "default-src 'self' {$viteOrigins}; script-src 'self' 'unsafe-inline' 'unsafe-eval' {$viteOrigins}; style-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://fonts.googleapis.com {$viteOrigins}; font-src 'self' data: https://cdnjs.cloudflare.com https://fonts.gstatic.com {$viteOrigins}; img-src 'self' data: https: {$viteOrigins}; connect-src 'self' https://en.wikipedia.org {$viteOrigins};";
        }
        
        $response->headers->set('Content-Security-Policy', $csp);
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Cross-Origin-Opener-Policy', 'same-origin');
        $response->headers->set('Cross-Origin-Resource-Policy', 'same-origin');

        return $response;
    }
}
