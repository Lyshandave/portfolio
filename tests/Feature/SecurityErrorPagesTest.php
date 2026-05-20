<?php

namespace Tests\Feature;

use Tests\TestCase;

class SecurityErrorPagesTest extends TestCase
{
    /**
     * Test the 403 Forbidden custom view.
     */
    public function test_403_error_page_renders_custom_view(): void
    {
        $response = $this->get('/errors/403');
        $response->assertStatus(403);
        $response->assertSee('Security Blocked');
        $response->assertSee('Your request has been flagged and intercepted');
        $response->assertSee('Secure Shield Active');
    }

    /**
     * Test the 404 Not Found custom view.
     */
    public function test_404_error_page_renders_custom_view(): void
    {
        $response = $this->get('/errors/404');
        $response->assertStatus(404);
        $response->assertSee('Page Not Found');
        $response->assertSee('The link you followed may be broken');
    }

    /**
     * Test the 500 Internal Server Error custom view.
     */
    public function test_500_error_page_renders_custom_view(): void
    {
        $response = $this->get('/errors/500');
        $response->assertStatus(500);
        $response->assertSee('System Error');
        $response->assertSee('stack traces have been completely hidden for security protection');
    }

    /**
     * Test the 501 Not Implemented custom view.
     */
    public function test_501_error_page_renders_custom_view(): void
    {
        $response = $this->get('/errors/501');
        $response->assertStatus(501);
        $response->assertSee('Not Implemented');
        $response->assertSee('The requested method or function is not supported');
    }

    /**
     * Test the 503 Service Unavailable custom view.
     */
    public function test_503_error_page_renders_custom_view(): void
    {
        $response = $this->get('/errors/503');
        $response->assertStatus(503);
        $response->assertSee('System Maintenance');
        $response->assertSee('We are temporarily offline');
    }
}
