<?php

namespace Tests\Feature\Http\Controllers\Management;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Management\LocationController
 */
class LocationControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create_returns_an_ok_response()
    {
        $countries = \App\Models\Country::factory()->times(3)->create();

        $response = $this->get(route('management.locations.create'));

        $response->assertStatus(302);
        $response->assertViewIs('backend.management.locations.create');
        $response->assertViewHas('countries', $countries);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function destroy_returns_an_ok_response()
    {
        $location = \App\Models\Location::factory()->create();

        $response = $this->delete(route('management.locations.destroy', [$location]));

        $response->assertRedirect(route('management.locations.index'));
        $this->assertDeleted($location);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function edit_returns_an_ok_response()
    {
        $location = \App\Models\Location::factory()->create();
        $countries = \App\Models\Country::factory()->times(3)->create();

        $response = $this->get(route('management.locations.edit', [$location]));

        $response->assertStatus(302);
        $response->assertViewIs('backend.management.locations.edit');
        $response->assertViewHas('location', $location);
        $response->assertViewHas('countries', $countries);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {
        $locations = \App\Models\Location::factory()->times(3)->create();

        $response = $this->get(route('management.locations.index'));

        $response->assertStatus(302);
        $response->assertViewIs('backend.management.locations.index');
        $response->assertViewHas('locations', $locations);
        $response->assertViewHas('lang');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function show_returns_an_ok_response()
    {
        $location = \App\Models\Location::factory()->create();

        $response = $this->get(route('management.locations.show', [$location]));

        $response->assertStatus(302);
        $response->assertViewIs('backend.management.locations.show');
        $response->assertViewHas('location', $location);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function store_returns_an_ok_response()
    {
        $response = $this->post(route('management.locations.store'), [
            // TODO: send request data
        ]);

        $response->assertRedirect(route('management.locations.index'));

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function update_returns_an_ok_response()
    {
        $location = \App\Models\Location::factory()->create();

        $response = $this->put(route('management.locations.update', [$location]), [
            // TODO: send request data
        ]);

        $response->assertRedirect(route('management.locations.index'));

        // TODO: perform additional assertions
    }

    // test cases...
}
