<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\HomeController
 */
class HomeControllerTest extends TestCase
{
    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {
        $response = $this->get('{any}');

        $response->assertOk();
        $response->assertViewIs($request->path());

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function root_returns_an_ok_response()
    {
        $response = $this->get(route('root'));

        $response->assertOk();
        $response->assertViewIs('frontend.home');

        // TODO: perform additional assertions
    }

    // test cases...
}
