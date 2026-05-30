<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_neighborhood_informational_pages_return_successful_response(): void
    {
        $this->get('/historia')->assertStatus(200);
        $this->get('/de-donde-vinimos')->assertStatus(200);
        $this->get('/hacia-donde-vamos')->assertStatus(200);
    }
}
