<?php

namespace Tests\Feature\Http\Controllers\Management;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Management\UserController
 */
class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create_returns_an_ok_response()
    {
        $organizations = \App\Models\Organization::factory()->times(3)->create();

        $response = $this->get(route('management.users.create'));

        $response->assertOk();
        $response->assertViewIs('backend.management.users.create');
        $response->assertViewHas('roles');
        $response->assertViewHas('organizations', $organizations);
        $response->assertViewHas('raceTeams');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function destroy_returns_an_ok_response()
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->delete(route('management.users.destroy', [$user]));

        $response->assertRedirect(route('management.users.index'));
        $this->assertDeleted($user);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function edit_returns_an_ok_response()
    {
        $user = \App\Models\User::factory()->create();
        $organizations = \App\Models\Organization::factory()->times(3)->create();
        $raceTeams = \App\Models\RaceTeam::factory()->times(3)->create();

        $response = $this->get(route('management.users.edit', [$user]));

        $response->assertOk();
        $response->assertViewIs('backend.management.users.edit');
        $response->assertViewHas('user', $user);
        $response->assertViewHas('roles');
        $response->assertViewHas('organizations', $organizations);
        $response->assertViewHas('raceTeams', $raceTeams);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {
        $users = \App\Models\User::factory()->times(3)->create();

        $response = $this->get(route('management.users.index'));

        $response->assertOk();
        $response->assertViewIs('backend.management.users.index');
        $response->assertViewHas('data');
        $response->assertViewHas('lang');
        $response->assertViewHas('organization');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function show_returns_an_ok_response()
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->get(route('management.users.show', [$user]));

        $response->assertOk();
        $response->assertViewIs('backend.management.users.show');
        $response->assertViewHas('user', $user);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function store_returns_an_ok_response()
    {
        $response = $this->post(route('management.users.store'), [
            // TODO: send request data
        ]);

        $response->assertRedirect(route('management.users.index'));

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function suspend_user_returns_an_ok_response()
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->patch(route('management.suspend_user', [$user]), [
            // TODO: send request data
        ]);

        $response->assertRedirect(back());

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function update_returns_an_ok_response()
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->put(route('management.users.update', [$user]), [
            // TODO: send request data
        ]);

        $response->assertRedirect(route('management.users.index'));

        // TODO: perform additional assertions
    }

    // test cases...
}
