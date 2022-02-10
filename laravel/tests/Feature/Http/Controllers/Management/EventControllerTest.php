<?php

namespace Tests\Feature\Http\Controllers\Management;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Management\EventController
 */
class EventControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create_returns_an_ok_response()
    {
        $users = \App\Models\User::factory()->times(3)->create();
        $organizations = \App\Models\Organization::factory()->times(3)->create();
        $locations = \App\Models\Location::factory()->times(3)->create();

        $response = $this->get(route('management.events.create'));

        $response->assertOk();
        $response->assertViewIs('backend.management.events.create');
        $response->assertViewHas('locations', $locations);
        $response->assertViewHas('users', $users);
        $response->assertViewHas('organizations', $organizations);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function destroy_returns_an_ok_response()
    {
        $event = \App\Models\Event::factory()->create();

        $response = $this->delete(route('management.events.destroy', [$event]));

        $response->assertRedirect(route('management.events.index'));
        $this->assertDeleted($event);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function edit_returns_an_ok_response()
    {
        $event = \App\Models\Event::factory()->create();
        $users = \App\Models\User::factory()->times(3)->create();
        $organizations = \App\Models\Organization::factory()->times(3)->create();
        $locations = \App\Models\Location::factory()->times(3)->create();

        $response = $this->get(route('management.events.edit', [$event]));

        $response->assertOk();
        $response->assertViewIs('backend.management.events.edit');
        $response->assertViewHas('event', $event);
        $response->assertViewHas('locations', $locations);
        $response->assertViewHas('users', $users);
        $response->assertViewHas('organizations', $organizations);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {
        $events = \App\Models\Event::factory()->times(3)->create();

        $response = $this->get(route('management.events.index'));

        $response->assertOk();
        $response->assertViewIs('backend.management.events.index');
        $response->assertViewHas('events', $events);
        $response->assertViewHas('lang');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function show_returns_an_ok_response()
    {
        $event = \App\Models\Event::factory()->create();

        $response = $this->get(route('management.events.show', [$event]));

        $response->assertOk();
        $response->assertViewIs('backend.management.events.show');
        $response->assertViewHas('event', $event);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function store_returns_an_ok_response()
    {
        $response = $this->post(route('management.events.store'), [
            // TODO: send request data
        ]);

        $response->assertRedirect(route('management.events.index'));

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function update_returns_an_ok_response()
    {
        $event = \App\Models\Event::factory()->create();

        $response = $this->put(route('management.events.update', [$event]), [
            // TODO: send request data
        ]);

        $response->assertRedirect(route('management.events.index'));

        // TODO: perform additional assertions
    }

    // test cases...
}
