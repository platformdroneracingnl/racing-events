<?php

namespace Tests\Feature\Http\Controllers\Management;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Management\OrganizationController
 */
class OrganizationControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create_returns_an_ok_response()
    {
        $organizations = \App\Models\Organization::factory()->times(3)->create();

        $response = $this->get(route('management.organizations.create'));

        $response->assertOk();
        $response->assertViewIs('backend.management.organizations.create');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function destroy_returns_an_ok_response()
    {
        $organization = \App\Models\Organization::factory()->create();

        $response = $this->delete(route('management.organizations.destroy', [$organization]));

        $response->assertRedirect(route('management.organizations.index'));
        $this->assertDeleted($organization);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function edit_returns_an_ok_response()
    {
        $organization = \App\Models\Organization::factory()->create();

        $response = $this->get(route('management.organizations.edit', [$organization]));

        $response->assertOk();
        $response->assertViewIs('backend.management.organizations.edit');
        $response->assertViewHas('organization', $organization);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {
        $organizations = \App\Models\Organization::factory()->times(3)->create();

        $response = $this->get(route('management.organizations.index'));

        $response->assertOk();
        $response->assertViewIs('backend.management.organizations.index');
        $response->assertViewHas('organizations', $organizations);
        $response->assertViewHas('lang');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function show_returns_an_ok_response()
    {
        $organization = \App\Models\Organization::factory()->create();

        $response = $this->get(route('management.organizations.show', [$organization]));

        $response->assertOk();
        $response->assertViewIs('backend.management.organizations.show');
        $response->assertViewHas('organization', $organization);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function store_returns_an_ok_response()
    {
        $response = $this->post(route('management.organizations.store'), [
            // TODO: send request data
        ]);

        $response->assertRedirect(route('management.organizations.index'));

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function update_returns_an_ok_response()
    {
        $organization = \App\Models\Organization::factory()->create();

        $response = $this->put(route('management.organizations.update', [$organization]), [
            // TODO: send request data
        ]);

        $response->assertRedirect(route('management.organizations.index'));

        // TODO: perform additional assertions
    }

    // test cases...
}
