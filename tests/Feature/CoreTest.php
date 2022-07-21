<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CoreTest extends TestCase
{
    /**
     * A basic feature to check that the records end point is active.
     * super basic but wanted to get at least one test in.
     *
     * @return void
     */
    public function test_remote_api_is_active()
    {
        $response = $this->get('/api/records');

        $response->assertStatus(200);
    }
}
