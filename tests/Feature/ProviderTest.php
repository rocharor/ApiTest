<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProviderTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testBasicTest()
    {
        $response = $this->get('/api/providers');

        $response->assertStatus(200);
    }
}
