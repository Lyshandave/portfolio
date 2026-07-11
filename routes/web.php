<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PortfolioApiController;

// Apply High Security & Anti-DDoS Rate Limiting (60 requests per minute per IP)
Route::middleware(['throttle:60,1'])->group(function () {
    Route::get('/', [PortfolioController::class, 'index']);
    Route::get('/tech-stack', [PortfolioController::class, 'techStack']);
    Route::get('/projects', [PortfolioController::class, 'projects']);
    Route::get('/projects/{slug}', [PortfolioController::class, 'caseStudy']);
    Route::get('/certifications', [PortfolioController::class, 'certifications']);
    Route::get('/api-data/v1/portfolio-data', [PortfolioApiController::class, 'getData']);
});

// Secure developer error page previews (only available in local/testing environments)
if (app()->environment('local', 'testing')) {
    Route::get('/errors/{code}', function ($code) {
        abort_if(!in_array($code, ['403', '404', '500', '501', '503']), 404);
        
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

        $info = $configs[(int) $code] ?? [];

        return \Inertia\Inertia::render('Error', [
            'status' => (int) $code,
            'title' => $info['title'] ?? 'Error',
            'message' => $info['message'] ?? 'Something went wrong',
            'description' => $info['description'] ?? '',
            'secure_shield' => $info['secure_shield'] ?? null,
        ])
        ->toResponse(request())
        ->setStatusCode((int) $code);
    });
}

