<?php

namespace Tests\Feature;

use Tests\TestCase;

class PortfolioSyncApiTest extends TestCase
{
    /**
     * Test the portfolio synchronization API endpoint.
     */
    public function test_portfolio_sync_api_returns_success_and_correct_structure(): void
    {
        $response = $this->getJson('/api/v1/portfolio-data');

        $response->assertStatus(200);
        $response->assertHeader('ETag');
        $response->assertHeader('Cache-Control', 'max-age=0, must-revalidate, public');

        // Verify JSON matches our controller structure
        $response->assertJsonStructure([
            'techStack' => [
                'Frontend',
                'Backend',
            ],
            'experience',
            'projects',
            'certifications',
        ]);

        // Verify the Cisco Packet Tracer experience exists (2025 experience requested by user)
        $response->assertJsonFragment([
            'role' => 'Networking Basics (Cisco Networking Academy)',
            'company' => 'Asian Institute of Computer Studies',
            'period' => '2025',
        ]);
    }

    /**
     * Test the ETag conditional request (HTTP 304 Not Modified).
     */
    public function test_portfolio_sync_api_returns_304_when_etag_matches(): void
    {
        // First request to grab the actual ETag
        $response1 = $this->get('/api/v1/portfolio-data');
        $response1->assertStatus(200);
        $etag = $response1->headers->get('ETag');

        $this->assertNotEmpty($etag);

        // Second request sending the If-None-Match header
        $response2 = $this->get('/api/v1/portfolio-data', [
            'If-None-Match' => $etag,
        ]);

        // Expect HTTP 304 (Not Modified) with empty body
        $response2->assertStatus(304);
        $this->assertEmpty($response2->getContent());
    }
}
