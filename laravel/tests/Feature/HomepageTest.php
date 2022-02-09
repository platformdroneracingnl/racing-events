<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomepageTest extends TestCase
{
    /**
     * @test
     * Assert a user can view homepage.
     *
     * @return void
     */
    public function test_user_can_view_homepage()
    {
        $response = $this->get('/');

        // 302 Because of language redirect
        $response->assertStatus(302);
        $response->assertViewIs('frontend.home');
    }
}