<?php

namespace Tests\Feature\Http\Controllers\Management;

use App\Models\Organization;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Management\OrganizationController
 */
class OrganizationControllerTest extends TestCase
{
    use RefreshDatabase, FeatureTestTrait;

    /**
     * INDEX
     * Assert that user cannot access the management organizations page.
     *
     * @test
     */
    public function test_view_all_organizations_cannot_be_accessed_by_pilot_users()
    {
        $this->actingAs($this->pilot)->get(route('management.organizations.index'))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * INDEX
     * Assert that user can access the management organizations page.
     *
     * @test
     */
    public function test_view_all_organizations_can_be_accessed_by_authorized_users()
    {
        $response = $this->actingAs($this->manager)->get(route('management.organizations.index'))->assertOk();

        $this->assertAuthenticated();
        $response->assertViewIs('backend.management.organizations.index');
        $response->assertViewHas('organizations');
        $response->assertViewHas('lang');
    }

    /**
     * VIEW / SHOW
     * Assert that user cannot access the specific organization page.
     *
     * @test
     */
    public function test_show_organization_cannot_be_accessed_by_pilot_users()
    {
        $organization = Organization::factory()->create();

        $this->actingAs($this->pilot)->get(route('management.organizations.show', $organization->id))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * VIEW / SHOW
     * Assert that user can access the specific organization page.
     *
     * @test
     */
    public function test_show_organization_can_be_accessed_by_authorized_users()
    {
        $organization = Organization::factory()->create();

        $response = $this->actingAs($this->manager)->get(route('management.organizations.show', $organization->id))->assertOk();

        $this->assertAuthenticated();
        $response->assertViewIs('backend.management.organizations.show');
        $response->assertViewHas('organization', $organization);
    }

    /**
     * CREATE
     * Assert that user cannot access the create organization page.
     *
     * @test
     */
    public function test_create_organization_cannot_be_accessed_by_pilot_users()
    {
        $this->actingAs($this->pilot)->get(route('management.organizations.create'))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * CREATE
     * Assert that user can access the create organization page.
     *
     * @test
     */
    public function test_create_organization_can_be_accessed_by_authorized_users()
    {
        $response = $this->actingAs($this->manager)->get(route('management.organizations.create'))->assertOk();

        $this->assertAuthenticated();
        $response->assertViewIs('backend.management.organizations.create');
    }

    /**
     * STORE
     * Assert that user cannot create a new organization.
     *
     * @test
     */
    public function test_store_new_organization_cannot_by_pilot_users()
    {
        $organization = Organization::factory()->make();

        $this->actingAs($this->pilot)->post(route('management.organizations.store'), $organization->toArray())->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * STORE
     * Assert that user can create a new organization.
     *
     * @test
     */
    public function test_store_new_organization_can_by_authorized_users()
    {
        $organization = Organization::factory()->make();

        $response = $this->actingAs($this->manager)->post(route('management.organizations.store'), $organization->toArray())->assertRedirect();

        $this->assertAuthenticated();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('organizations', [
            'name' => $organization->name,
        ]);
    }

    /**
     * EDIT
     * Assert that user cannot access the edit organization page.
     *
     * @test
     */
    public function test_edit_organization_cannot_be_accessed_by_pilot_users()
    {
        $organization = Organization::factory()->create();

        $this->actingAs($this->pilot)->get(route('management.organizations.edit', $organization->id))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * EDIT
     * Assert that user can access the edit organization page.
     *
     * @test
     */
    public function test_edit_organization_can_be_accessed_by_authorized_users()
    {
        $organization = Organization::factory()->create();

        $response = $this->actingAs($this->manager)->get(route('management.organizations.edit', $organization->id))->assertOk();

        $this->assertAuthenticated();
        $response->assertViewIs('backend.management.organizations.edit');
        $response->assertViewHas('organization', $organization);
    }

    /**
     * UPDATE
     * Assert that user cannot update the organization.
     *
     * @test
     */
    public function test_update_organization_cannot_by_pilot_users()
    {
        $organization = Organization::factory()->create();

        $this->actingAs($this->pilot)->put(route('management.organizations.update', $organization->id), $organization->toArray())->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * UPDATE
     * Assert that user can update the organization.
     *
     * @test
     */
    public function test_update_organization_can_by_authorized_users()
    {
        $organization = Organization::factory()->create();

        $response = $this->actingAs($this->manager)->put(route('management.organizations.update', $organization->id), $organization->toArray())->assertRedirect();

        $this->assertAuthenticated();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('organizations', [
            'name' => $organization->name,
        ]);
    }

    /**
     * DESTROY
     * Assert that user cannot delete the organization.
     *
     * @test
     */
    public function test_destroy_organization_cannot_by_pilot_users()
    {
        $organization = Organization::factory()->create();

        $this->actingAs($this->pilot)->delete(route('management.organizations.destroy', $organization->id))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * DESTROY
     * Assert that user can delete the organization.
     *
     * @test
     */
    public function test_destroy_organization_can_by_authorized_users()
    {
        $organization = Organization::factory()->create();

        $response = $this->actingAs($this->manager)->delete(route('management.organizations.destroy', $organization->id))->assertRedirect();

        $this->assertAuthenticated();
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('organizations', $organization->toArray());
    }
}
