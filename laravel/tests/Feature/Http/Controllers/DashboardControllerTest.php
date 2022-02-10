<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DashboardController
 */
class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function change_layout_returns_an_ok_response()
    {
        $response = $this->get(route('layout'));

        $response->assertRedirect(back());

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {
        $events = \App\Models\Event::factory()->times(3)->create();
        $registrations = \App\Models\Registration::factory()->times(3)->create();

        $response = $this->get(route('dashboard'));

        $response->assertOk();
        $response->assertViewIs('backend.index');
        $response->assertViewHas('events', $events);
        $response->assertViewHas('agent');
        $response->assertViewHas('registrations', $registrations);

        // TODO: perform additional assertions
    }

    // test cases...
}
