<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(at: '*');
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
        ]);
        $middleware->append(\App\Http\Middleware\SecurityHeaders::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->respond(function ($response, $exception, $request) {
            $code = $response->getStatusCode();
            if (in_array($code, [403, 404, 500, 501, 503])) {
                $configs = [
                    403 => [
                        'title' => 'Access Denied',
                        'message' => 'Security Blocked',
                        'description' => 'Your request has been flagged and intercepted by our high-security firewall shield. If you believe this is an error, please try refreshing or verify your credentials.',
                        'secure_shield' => 'Secure Shield Active',
                    ],
                    404 => [
                        'title' => 'Page Not Found',
                        'message' => 'Page Not Found',
                        'description' => 'The link you followed may be broken, or the page has been moved. Let\'s get you back to the portfolio so you can continue exploring.',
                    ],
                    500 => [
                        'title' => 'Server Error',
                        'message' => 'System Error',
                        'description' => 'An unexpected error occurred on our server. The incident has been securely logged, and stack traces have been completely hidden for security protection.',
                    ],
                    501 => [
                        'title' => 'Not Implemented',
                        'message' => 'Not Implemented',
                        'description' => 'The requested method or function is not supported or implemented on our secure server gateway. Please return home or check your connection.',
                    ],
                    503 => [
                        'title' => 'Service Unavailable',
                        'message' => 'System Maintenance',
                        'description' => 'We are temporarily offline conducting scheduled security hardening and upgrades. Our portfolio will be back online shortly.',
                    ]
                ];
                
                $info = $configs[$code] ?? [];
                return \Inertia\Inertia::render('Error', [
                    'status' => $code,
                    'title' => $info['title'] ?? 'Error',
                    'message' => $info['message'] ?? 'Something went wrong',
                    'description' => $info['description'] ?? '',
                    'secure_shield' => $info['secure_shield'] ?? null,
                ])
                ->toResponse($request)
                ->setStatusCode($code);
            }
            return $response;
        });
    })->create();
