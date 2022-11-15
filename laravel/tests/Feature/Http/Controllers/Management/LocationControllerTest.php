<?php

namespace Tests\Feature\Http\Controllers\Management;

use App\Models\Country;
use App\Models\Location;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Management\LocationController
 */
class LocationControllerTest extends TestCase
{
    use RefreshDatabase, FeatureTestTrait;

    /**
     * INDEX
     * Assert that user cannot access the management locations page.
     *
     * @test
     */
    public function test_view_all_locations_cannot_be_accessed_by_pilot_users()
    {
        $this->actingAs($this->pilot)->get(route('management.locations.index'))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * INDEX
     * Assert that user can access the management locations page.
     *
     * @test
     */
    public function test_view_all_locations_can_be_accessed_by_authorized_users()
    {
        $response = $this->actingAs($this->manager)->get(route('management.locations.index'))->assertOk();

        $this->assertAuthenticated();
        $response->assertViewIs('backend.management.locations.index');
        $response->assertViewHas('locations');
        $response->assertViewHas('lang');
    }

    /**
     * VIEW / SHOW
     * Assert that user cannot access the specific location page.
     *
     * @test
     */
    public function test_show_location_cannot_be_accessed_by_pilot_users()
    {
        $location = Location::factory()->create();

        $this->actingAs($this->pilot)->get(route('management.locations.show', $location->id))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * VIEW / SHOW
     * Assert that user can access the specific location page.
     *
     * @test
     */
    public function test_show_location_can_be_accessed_by_authorized_users()
    {
        $location = Location::factory()->create();

        $response = $this->actingAs($this->manager)->get(route('management.locations.show', $location->id))->assertOk();

        $this->assertAuthenticated();
        $response->assertViewIs('backend.management.locations.show');
        $response->assertViewHas('location', $location);
    }

    /**
     * CREATE
     * Assert that user cannot access the create location page.
     *
     * @test
     */
    public function test_create_location_cannot_be_accessed_by_pilot_users()
    {
        $this->actingAs($this->pilot)->get(route('management.locations.create'))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * CREATE
     * Assert that user can access the create location page.
     *
     * @test
     */
    public function test_create_location_can_be_accessed_by_authorized_users()
    {
        $response = $this->actingAs($this->manager)->get(route('management.locations.create'))->assertOk();

        $this->assertAuthenticated();
        $response->assertViewIs('backend.management.locations.create');
        $response->assertViewHas('countries', Country::all());
    }

    /**
     * STORE
     * Assert that user cannot store a new location.
     *
     * @test
     */
    public function test_store_new_location_cannot_by_pilot_users()
    {
        $location = Location::factory()->make();

        $this->actingAs($this->pilot)->post(route('management.locations.store'), $location->toArray())->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * STORE
     * Assert that user can store a new location.
     *
     * @test
     */
    public function test_store_new_location_can_by_authorized_users()
    {
        $location = Location::factory()->make();

        $response = $this->actingAs($this->manager)->post(route('management.locations.store'), $location->toArray())->assertRedirect();

        $this->assertAuthenticated();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('locations', $location->toArray());
    }

    /**
     * EDIT
     * Assert that user cannot access the edit location page.
     *
     * @test
     */
    public function test_edit_location_cannot_be_accessed_by_pilot_users()
    {
        $location = Location::factory()->create();

        $this->actingAs($this->pilot)->get(route('management.locations.edit', $location->id))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * EDIT
     * Assert that user can access the edit location page.
     *
     * @test
     */
    public function test_edit_location_can_be_accessed_by_authorized_users()
    {
        $location = Location::factory()->create();

        $response = $this->actingAs($this->manager)->get(route('management.locations.edit', $location->id))->assertOk();

        $this->assertAuthenticated();
        $response->assertViewIs('backend.management.locations.edit');
        $response->assertViewHas('location', $location);
        $response->assertViewHas('countries', Country::all());
    }

    /**
     * UPDATE
     * Assert that user cannot update a location.
     *
     * @test
     */
    public function test_update_location_cannot_by_pilot_users()
    {
        $location = Location::factory()->create();

        $this->actingAs($this->pilot)->put(route('management.locations.update', $location->id), $location->toArray())->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * UPDATE
     * Assert that user can update a location.
     *
     * @test
     */
    public function test_update_location_can_by_authorized_users()
    {
        $location = Location::factory()->create();

        $response = $this->actingAs($this->manager)->put(route('management.locations.update', $location->id), $location->toArray())->assertRedirect();

        $this->assertAuthenticated();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('locations', [
            'id' => $location->id,
            'name' => $location->name,
            'street' => $location->street,
            'zip_code' => $location->zip_code,
            'city' => $location->city,
            'country_id' => $location->country_id,
        ]);
    }

    /**
     * DESTROY
     * Assert that user cannot delete a location.
     *
     * @test
     */
    public function test_destroy_location_cannot_by_pilot_users()
    {
        $location = Location::factory()->create();

        $this->actingAs($this->pilot)->delete(route('management.locations.destroy', $location->id))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * DESTROY
     * Assert that user can delete a location.
     *
     * @test
     */
    public function test_destroy_location_can_by_authorized_users()
    {
        $location = Location::factory()->create();

        $response = $this->actingAs($this->manager)->delete(route('management.locations.destroy', $location->id))->assertRedirect();

        $this->assertAuthenticated();
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('locations', $location->toArray());
    }
}
