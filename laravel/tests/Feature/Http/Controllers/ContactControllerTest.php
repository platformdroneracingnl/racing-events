<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ContactController
 */
class ContactControllerTest extends TestCase
{
    /**
     * @test
     */
    public function index_returns_an_ok_response(): void
    {
        $response = $this->get(route('contact'));

        $response->assertStatus(200);
        $response->assertViewIs('frontend.contact');

        // TODO: perform additional assertions
    }
}
