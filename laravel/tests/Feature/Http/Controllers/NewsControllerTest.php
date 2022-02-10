<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\NewsController
 */
class NewsControllerTest extends TestCase
{
    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {
        $this->refreshApplicationWithLocale('en');

        $response = $this->get(route('news'));

        $response->assertStatus(200);
        $response->assertViewIs('backend.news.index');

        // TODO: perform additional assertions
    }
}
