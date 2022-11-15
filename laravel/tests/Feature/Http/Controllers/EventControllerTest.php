<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\EventController
 */
class EventControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $events = \App\Models\Event::factory()->times(3)->create();

        $response = $this->get(route('events'));

        $response->assertOk();
        $response->assertViewIs('backend.events.index');
        $response->assertViewHas('events', $events);
        $response->assertViewHas('lang');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function show_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $event = \App\Models\Event::factory()->create();

        $response = $this->get(route('events.show', [$event]));

        $response->assertOk();
        $response->assertViewIs('backend.events.show');
        $response->assertViewHas('event', $event);
        $response->assertViewHas('lang');
        $response->assertViewHas('agent');
        $response->assertViewHas('finalOrganizator');

        // TODO: perform additional assertions
    }

    // test cases...
}
