<?php

namespace Tests\Feature\Http\Controllers\Management;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Management\RoleController
 */
class RoleControllerTest extends TestCase
{
    /**
     * @test
     */
    public function create_returns_an_ok_response()
    {
        $response = $this->get(route('management.roles.create'));

        $response->assertOk();
        $response->assertViewIs('backend.management.roles.create');
        $response->assertViewHas('permission');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function destroy_returns_an_ok_response()
    {
        $response = $this->delete(route('management.roles.destroy', ['role' => $role]));

        $response->assertRedirect(route('management.roles.index'));
        $this->assertDeleted($role);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function edit_returns_an_ok_response()
    {
        $response = $this->get(route('management.roles.edit', ['role' => $role]));

        $response->assertOk();
        $response->assertViewIs('backend.management.roles.edit');
        $response->assertViewHas('role');
        $response->assertViewHas('permission');
        $response->assertViewHas('rolePermissions');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {
        $response = $this->get(route('management.roles.index'));

        $response->assertOk();
        $response->assertViewIs('backend.management.roles.index');
        $response->assertViewHas('roles');
        $response->assertViewHas('lang');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function show_returns_an_ok_response()
    {
        $response = $this->get(route('management.roles.show', ['role' => $role]));

        $response->assertOk();
        $response->assertViewIs('backend.management.roles.show');
        $response->assertViewHas('role');
        $response->assertViewHas('rolePermissions');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function store_returns_an_ok_response()
    {
        $response = $this->post(route('management.roles.store'), [
            // TODO: send request data
        ]);

        $response->assertRedirect(route('management.roles.index'));

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function update_returns_an_ok_response()
    {
        $response = $this->put(route('management.roles.update', ['role' => $role]), [
            // TODO: send request data
        ]);

        $response->assertRedirect(route('management.roles.index'));

        // TODO: perform additional assertions
    }

    // test cases...
}
