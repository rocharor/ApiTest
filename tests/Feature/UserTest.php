<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
