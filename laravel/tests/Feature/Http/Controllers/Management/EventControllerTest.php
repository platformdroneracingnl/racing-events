<?php

namespace Tests\Feature\Http\Controllers\Management;

use App\Models\Event;
use App\Models\Location;
use App\Models\Organization;
use App\Models\User;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Management\EventController
 */
class EventControllerTest extends TestCase
{
    use RefreshDatabase, FeatureTestTrait;

    /**
     * INDEX
     * Assert that user cannot access the management events page.
     *
     * @test
     */
    public function test_view_all_events_cannot_be_accessed_by_pilot_users(): void
    {
        $this->actingAs($this->pilot)->get(route('management.events.index'))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * INDEX
     * Assert that user can access the management events page.
     *
     * @test
     */
    public function test_view_all_events_can_be_accessed_by_authorized_users(): void
    {
        $response = $this->actingAs($this->manager)->get(route('management.events.index'))->assertOk();

        $this->assertAuthenticated();
        $response->assertViewIs('backend.management.events.index');
        $response->assertViewHas('events');
    }

    /**
     * VIEW / SHOW
     * Assert that user cannot access the specific event page.
     *
     * @test
     */
    public function test_show_event_cannot_be_accessed_by_pilot_users(): void
    {
        $event = Event::factory()->create();

        $this->actingAs($this->pilot)->get(route('management.events.show', $event->id))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * VIEW / SHOW
     * Assert that user can access the specific event page.
     *
     * @test
     */
    public function test_show_event_can_be_accessed_by_authorized_users(): void
    {
        $event = Event::factory()->create();

        $response = $this->actingAs($this->manager)->get(route('management.events.show', [$event]))->assertOk();

        $this->assertAuthenticated();
        $response->assertViewIs('backend.management.events.show');
        $response->assertViewHas('event', $event);
    }

    /**
     * CREATE
     * Assert that user cannot access the create event page.
     *
     * @test
     */
    public function test_create_event_cannot_be_accessed_by_pilot_users(): void
    {
        $this->actingAs($this->pilot)->get(route('management.events.create'))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * CREATE
     * Assert that user can access the create event page.
     *
     * @test
     */
    public function test_create_event_can_be_accessed_by_authorized_users(): void
    {
        $user = User::factory()->create();
        $organizations = Organization::factory()->count(3)->create();
        $locations = Location::factory()->count(3)->create();

        $response = $this->actingAs($this->manager)->get(route('management.events.create'))->assertOk();

        $this->assertAuthenticated();
        $response->assertViewIs('backend.management.events.create');
        $response->assertViewHas('organizations', $organizations);
        $response->assertViewHas('locations', $locations);
    }

    /**
     * STORE
     * Assert that user cannot store a new event.
     *
     * @test
     */
    public function test_store_new_event_cannot_by_pilot_users(): void
    {
        $event = Event::factory()->make();

        $this->actingAs($this->pilot)->post(route('management.events.store'), $event->toArray())->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * STORE
     * Assert that user can store a new event.
     *
     * @test
     */
    // public function test_store_new_event_can_by_authorized_users()
    // {
    //     $event = Event::factory()->make();

    //     $response = $this->authorized_user(['event-create'])->post(route('management.events.store'), $event->toArray())->assertRedirect();

    //     $this->assertAuthenticated();
    //     $response->assertSessionHas('success');
    //     $this->assertDatabaseHas('events', $event->toArray());
    // }

    /**
     * EDIT
     * Assert that user cannot access the edit event page.
     *
     * @test
     */
    public function test_edit_event_cannot_be_accessed_by_pilot_users(): void
    {
        $event = Event::factory()->create();

        $this->actingAs($this->pilot)->get(route('management.events.edit', $event->id))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * EDIT
     * Assert that user can access the edit event page.
     *
     * @test
     */
    public function test_edit_event_can_be_accessed_by_authorized_users(): void
    {
        $event = Event::factory()->create();
        $organizations = Organization::factory()->count(3)->create();

        $response = $this->actingAs($this->manager)->get(route('management.events.edit', $event->id));

        $response->assertOk();
        $response->assertViewIs('backend.management.events.edit');
        $response->assertViewHas('event', $event);
        $response->assertViewHas('locations');
        $response->assertViewHas('organizations', $organizations);
    }

    /**
     * UPDATE
     * Assert that user cannot update an event.
     *
     * @test
     */
    public function test_update_event_cannot_by_pilot_users(): void
    {
        $event = Event::factory()->create();
        $event->name = 'Updated Event Name';

        $this->actingAs($this->pilot)->put(route('management.events.update', $event->id), $event->toArray())->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * UPDATE
     * Assert that user can update an event.
     *
     * @test
     */
    // public function test_update_event_can_by_authorized_users()
    // {
    //     $event = Event::factory()->create();
    //     $event->name = 'Updated Event Name';

    //     $response = $this->authorized_user(['event-update'])->put(route('management.events.update', $event->id), $event->toArray())->assertRedirect();

    //     $this->assertAuthenticated();
    //     $response->assertSessionHas('success');
    //     $this->assertDatabaseHas('events', $event->toArray());
    // }

    /**
     * DELETE / DESTROY
     * Assert that user cannot delete an event.
     *
     * @test
     */
    public function test_delete_event_cannot_by_pilot_users(): void
    {
        $event = Event::factory()->create();

        $this->actingAs($this->pilot)->delete(route('management.events.destroy', $event->id))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * DELETE / DESTROY
     * Assert that user can delete an event.
     *
     * @test
     */
    public function test_delete_event_can_by_authorized_users(): void
    {
        $event = Event::factory()->create();

        $response = $this->actingAs($this->manager)->delete(route('management.events.destroy', $event->id))->assertRedirect();

        $this->assertAuthenticated();
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('events', $event->toArray());
    }
}
