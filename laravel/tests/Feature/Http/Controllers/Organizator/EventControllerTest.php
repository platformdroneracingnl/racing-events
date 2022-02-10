<?php

namespace Tests\Feature\Http\Controllers\Organizator;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Organizator\EventController
 */
class EventControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create_returns_an_ok_response()
    {
        $locations = \App\Models\Location::factory()->times(3)->create();

        $response = $this->get(route('organizator.events.create'));

        $response->assertOk();
        $response->assertViewIs('backend.organizator.events.create');
        $response->assertViewHas('locations', $locations);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function destroy_returns_an_ok_response()
    {
        $event = \App\Models\Event::factory()->create();

        $response = $this->delete(route('organizator.events.destroy', [$event]));

        $response->assertRedirect(route('organizator.events.index'));
        $this->assertDeleted($event);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function edit_returns_an_ok_response()
    {
        $event = \App\Models\Event::factory()->create();
        $locations = \App\Models\Location::factory()->times(3)->create();

        $response = $this->get(route('organizator.events.edit', [$event]));

        $response->assertOk();
        $response->assertViewIs('backend.organizator.events.edit');
        $response->assertViewHas('event', $event);
        $response->assertViewHas('locations', $locations);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->get(route('organizator.events.index'));

        $response->assertOk();
        $response->assertViewIs('backend.organizator.events.index');
        $response->assertViewHas('events');
        $response->assertViewHas('lang');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function show_returns_an_ok_response()
    {
        $event = \App\Models\Event::factory()->create();
        $registrations = \App\Models\Registration::factory()->times(3)->create();

        $response = $this->get(route('organizator.events.show', [$event]));

        $response->assertOk();
        $response->assertViewIs('backend.organizator.events.show');
        $response->assertViewHas('event', $event);
        $response->assertViewHas('agent');
        $response->assertViewHas('complete_reg');
        $response->assertViewHas('pending_reg');
        $response->assertViewHas('price_total');
        $response->assertViewHas('price_subtotal');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function store_returns_an_ok_response()
    {
        $response = $this->post(route('organizator.events.store'), [
            // TODO: send request data
        ]);

        $response->assertRedirect(route('organizator.events.index'));

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function update_returns_an_ok_response()
    {
        $event = \App\Models\Event::factory()->create();

        $response = $this->put(route('organizator.events.update', [$event]), [
            // TODO: send request data
        ]);

        $response->assertRedirect(route('organizator.events.index'));

        // TODO: perform additional assertions
    }

    // test cases...
}
