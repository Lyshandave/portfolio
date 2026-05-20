<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PortfolioApiController extends Controller
{
    /**
     * Get the portfolio data with high-performance ETag/HTTP 304 caching.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Controllers\PortfolioController  $portfolioController
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function getData(Request $request, PortfolioController $portfolioController)
    {
        $data = $portfolioController->getPortfolioData();
        
        // Generate a secure, deterministic ETag hash representing the current portfolio data state
        $jsonData = json_encode($data);
        $etag = '"' . md5($jsonData) . '"';
        
        // Check If-None-Match header from browser cache
        $ifNoneMatch = $request->header('If-None-Match');
        
        // Return HTTP 304 Not Modified if ETag matches (instant load, 0 bytes bandwidth)
        if ($ifNoneMatch && trim($ifNoneMatch) === $etag) {
            return response('', 304)->withHeaders([
                'ETag' => $etag,
                'Cache-Control' => 'public, max-age=0, must-revalidate',
            ]);
        }
        
        // Return full JSON with ETag cache instructions
        return response()->json($data)->withHeaders([
            'ETag' => $etag,
            'Cache-Control' => 'public, max-age=0, must-revalidate',
        ]);
    }
}
