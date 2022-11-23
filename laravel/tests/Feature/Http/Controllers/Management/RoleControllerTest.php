<?php

namespace Tests\Feature\Http\Controllers\Management;

use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Management\RoleController
 */
class RoleControllerTest extends TestCase
{
    use RefreshDatabase, FeatureTestTrait;

    /**
     * INDEX VIEW
     * Assert that user cannot access the roles page.
     *
     * @test
     */
    public function test_view_all_roles_cannot_be_accessed_by_unauthorized_users()
    {
        $this->unauthorized_user()->get(route('management.roles.index'))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * INDEX VIEW
     * Assert that user can access the roles page.
     *
     * @test
     */
    public function test_view_all_roles_can_be_accessed_by_authorized_users()
    {
        $response = $this->actingAs($this->manager)->get(route('management.roles.index'));

        $this->assertAuthenticated();
        $response->assertOk();
        $response->assertViewIs('backend.management.roles.index');
    }

    /**
     * CREATE
     * Assert that user cannot access the create role page.
     *
     * @test
     */
    public function test_create_role_cannot_be_accessed_by_unauthorized_users()
    {
        $response = $this->unauthorized_user()->get(route('management.roles.create'));

        $this->assertAuthenticated();
        $response->assertForbidden();
    }

    /**
     * CREATE
     * Assert that user can create a new role.
     *
     * @test
     */
    public function test_create_role_can_only_be_accessed_by_supervisor_users()
    {
        $response = $this->actingAs($this->supervisor)->get(route('management.roles.create'));

        $this->assertAuthenticated();
        $response->assertOk();
        $response->assertViewIs('backend.management.roles.create');
        $response->assertViewHas('permission');
    }

    /**
     * STORE
     * Assert that user cannot store a new role.
     *
     * @test
     */
    public function test_store_role_cannot_be_accessed_by_unauthorized_users()
    {
        $this->unauthorized_user()->post(route('management.roles.store'), [
            'name' => 'test',
            'permission' => ['user-read'],
        ])->assertForbidden();
    }

    /**
     * STORE
     * Assert that user can store a new role.
     *
     * @test
     */
    public function test_store_role_can_only_be_accessed_by_supervisor_users()
    {
        $response = $this->actingAs($this->supervisor)->post(route('management.roles.store'), [
            'name' => 'test',
            'permission' => ['role-read'],
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('management.roles.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('roles', [
            'name' => ['test'],
        ]);
    }

    /**
     * EDIT
     * Assert that user cannot access the edit role page.
     *
     * @test
     */
    public function test_edit_role_cannot_be_accessed_by_unauthorized_users()
    {
        $this->unauthorized_user()->get(route('management.roles.edit', ['role' => 1]))->assertForbidden();
    }

    /**
     * EDIT
     * Assert that user can edit a role.
     *
     * @test
     */
    public function test_edit_role_can_be_accessed_by_authorized_users()
    {
        $response = $this->actingAs($this->supervisor)->get(route('management.roles.edit', ['role' => 1]));

        $this->assertAuthenticated();
        $response->assertOk();
        $response->assertViewIs('backend.management.roles.edit');
    }

    /**
     * UPDATE
     * Assert that user cannot update a role.
     *
     * @test
     */
    public function test_update_role_cannot_be_accessed_by_unauthorized_users()
    {
        $this->unauthorized_user()->put(route('management.roles.update', ['role' => 1]), [
            'name' => 'test',
            'permission' => ['test'],
        ])->assertForbidden();
    }

    /**
     * UPDATE
     * Assert that user can update a role.
     *
     * @test
     */
    public function test_update_role_can_be_accessed_by_authorized_users()
    {
        $response = $this->actingAs($this->supervisor)->patch(route('management.roles.update', ['role' => 1]), [
            'name' => 'test',
            'permission' => ['role-read'],
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('management.roles.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('roles', [
            'name' => 'test',
        ]);
    }

    /**
     * DESTROY
     * Assert that user cannot delete a role.
     *
     * @test
     */
    public function test_destroy_role_cannot_be_accessed_by_unauthorized_users()
    {
        $response = $this->unauthorized_user()->delete(route('management.roles.destroy', ['role' => 1]))->assertForbidden();
        $response->assertStatus(403);
    }

    /**
     * DESTROY
     * Assert that user can delete a role.
     *
     * @test
     */
    public function test_destroy_role_can_only_be_accessed_by_supervisor_users()
    {
        $response = $this->actingAs($this->supervisor)->delete(route('management.roles.destroy', ['role' => 1]));

        $this->assertAuthenticated();
        $response->assertSessionHas('success');
        $response->assertRedirect(route('management.roles.index'));
        $this->assertDatabaseMissing('roles', ['id' => 1]);
    }
}
