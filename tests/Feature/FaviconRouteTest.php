<?php

namespace Tests\Feature;

use Tests\TestCase;

class FaviconRouteTest extends TestCase
{
    public function test_favicon_ico_returns_png_bytes_and_content_type(): void
    {
        $this->artisan('branding:generate');

        $response = $this->get('/favicon.ico');

        $response->assertOk();
        $response->assertHeaderContains('content-type', 'image/png');

        $body = $response->streamedContent();
        $this->assertNotSame('', $body);
        $this->assertStringStartsWith("\x89PNG\r\n\x1a\n", $body);
    }
}
