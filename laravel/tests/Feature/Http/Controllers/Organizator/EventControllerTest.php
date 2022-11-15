<?php

namespace Tests\Feature\Http\Controllers\Organizator;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Organizator\EventController
 */
class EventControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * INDEX
     * Assert that other users cannot access the organizator events page.
     *
     * @test
     */
    public function test_view_all_events_cannot_be_accessed_by_pilot_users()
    {
        $this->actingAs($this->pilot)->get(route('organizator.events.index'))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * INDEX
     * Assert that authorized user can access the organizator events page.
     *
     * @test
     */
    public function test_view_all_events_can_be_accessed_by_authorized_users()
    {
        $events = Event::factory([
            'user_id' => $this->organizer->id,
        ])->count(5)->create();

        $response = $this->actingAs($this->organizer)->get(route('organizator.events.index'))->assertOk();

        $this->assertAuthenticated();
        $response->assertViewIs('backend.organizator.events.index');
        $this->assertDatabaseCount('events', 5);
        $this->assertDatabaseHas('events', [
            'user_id' => $this->organizer->id,
        ]);
    }

    /**
     * SHOW
     * Assert that other users cannot access the organizator event page.
     *
     * @test
     */
    public function test_view_event_cannot_be_accessed_by_pilot_users()
    {
        $event = Event::factory([
            'user_id' => $this->organizer->id,
        ])->create();

        $this->actingAs($this->pilot)->get(route('organizator.events.show', $event->id))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * SHOW
     * Assert that authorized user can access the organizator event page.
     *
     * @test
     */
    public function test_view_event_can_be_accessed_by_authorized_users()
    {
        $event = Event::factory([
            'user_id' => $this->organizer->id,
        ])->create();

        $response = $this->actingAs($this->organizer)->get(route('organizator.events.show', $event->id))->assertOk();

        $this->assertAuthenticated();
        $response->assertViewIs('backend.organizator.events.show');
        $response->assertViewHas('event', $event);
        $this->assertDatabaseHas('events', [
            'user_id' => $this->organizer->id,
        ]);
    }

    /**
     * CREATE
     * Assert that other users cannot access the organizator event create page.
     *
     * @test
     */
    public function test_create_event_cannot_be_accessed_by_pilot_users()
    {
        $this->actingAs($this->pilot)->get(route('organizator.events.create'))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * CREATE
     * Assert that authorized user can access the organizator event create page.
     *
     * @test
     */
    public function test_create_event_can_be_accessed_by_authorized_users()
    {
        $response = $this->actingAs($this->organizer)->get(route('organizator.events.create'))->assertOk();

        $this->assertAuthenticated();
        $response->assertViewIs('backend.organizator.events.create');
    }

    /**
     * STORE
     * Assert that other users cannot create an event.
     *
     * @test
     */
    public function test_event_cannot_be_created_by_pilot_users()
    {
        $event = Event::factory()->make();

        $this->actingAs($this->pilot)->post(route('organizator.events.store'), $event->toArray())->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * STORE
     * Assert that authorized user can create an event.
     *
     * @test
     */
    // public function test_event_can_be_created_by_authorized_users()
    // {
    //     $event = Event::factory()->make();

    //     $response = $this->actingAs($this->organizer)->post(route('organizator.events.store'), $event->toArray())->assertRedirect();

    //     $this->assertAuthenticated();
    //     $response->assertSessionHas('success');
    //     $this->assertDatabaseHas('events', [
    //         'user_id' => $this->organizer->id,
    //     ]);
    // }

    /**
     * EDIT
     * Assert that other users cannot access the organizator event edit page.
     *
     * @test
     */
    public function test_edit_event_cannot_be_accessed_by_pilot_users()
    {
        $event = Event::factory()->create();

        $this->actingAs($this->pilot)->get(route('organizator.events.edit', $event->id))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * EDIT
     * Assert that authorized user can access the organizator event edit page.
     *
     * @test
     */
    public function test_edit_event_can_be_accessed_by_authorized_users()
    {
        $event = Event::factory([
            'user_id' => $this->organizer->id,
        ])->create();

        $response = $this->actingAs($this->organizer)->get(route('organizator.events.edit', $event->id))->assertOk();

        $this->assertAuthenticated();
        $response->assertViewIs('backend.organizator.events.edit');
        $response->assertViewHas('event', $event);
        $this->assertDatabaseHas('events', [
            'user_id' => $this->organizer->id,
        ]);
    }

    /**
     * UPDATE
     * Assert that other users cannot update an event.
     *
     * @test
     */
    public function test_event_cannot_be_updated_by_pilot_users()
    {
        $event = Event::factory()->create();

        $this->actingAs($this->pilot)->put(route('organizator.events.update', $event->id), $event->toArray())->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * UPDATE
     * Assert that authorized user can update an event.
     *
     * @test
     */
    public function test_event_can_be_updated_by_authorized_users()
    {
        $event = Event::factory([
            'user_id' => $this->organizer->id,
            'name' => 'Test Event',
            'description' => 'Test Description',
        ])->create();

        $response = $this->actingAs($this->organizer)->put(route('organizator.events.update', $event->id), $event->toArray())->assertRedirect();

        $this->assertAuthenticated();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('events', [
            'user_id' => $this->organizer->id,
            'name' => 'Test Event',
            'description' => 'Test Description',
        ]);
    }

    /**
     * DESTROY
     * Assert that other users cannot delete an event.
     *
     * @test
     */
    public function test_event_cannot_be_deleted_by_pilot_users()
    {
        $event = Event::factory()->create();

        $this->actingAs($this->pilot)->delete(route('organizator.events.destroy', $event->id))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * DESTROY
     * Assert that authorized user can delete an event.
     *
     * @test
     */
    public function test_event_can_be_deleted_by_authorized_users()
    {
        $event = Event::factory([
            'user_id' => $this->organizer->id,
        ])->create();

        $response = $this->actingAs($this->organizer)->delete(route('organizator.events.destroy', $event->id))->assertRedirect();

        $this->assertAuthenticated();
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('events', [
            'user_id' => $this->organizer->id,
        ]);
    }
}
