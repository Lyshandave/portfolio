<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PortfolioApiController;

// Apply High Security & Anti-DDoS Rate Limiting (60 requests per minute per IP)
Route::middleware(['throttle:60,1'])->group(function () {
    Route::get('/', [PortfolioController::class, 'index']);
    Route::get('/tech-stack', [PortfolioController::class, 'techStack']);
    Route::get('/projects', [PortfolioController::class, 'projects']);
    Route::get('/certifications', [PortfolioController::class, 'certifications']);
    Route::get('/api/v1/portfolio-data', [PortfolioApiController::class, 'getData']);
});

// Secure developer error page previews (only available in local/testing environments)
if (app()->environment('local', 'testing')) {
    Route::get('/errors/{code}', function ($code) {
        abort_if(!in_array($code, ['403', '404', '500', '501', '503']), 404);
        return response()->view("errors.{$code}", [], $code);
    });
}

