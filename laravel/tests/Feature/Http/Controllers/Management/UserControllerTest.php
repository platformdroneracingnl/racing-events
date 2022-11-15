<?php

namespace Tests\Feature\Http\Controllers\Management;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\RaceTeam;
use App\Models\Organization;
use App\Traits\FeatureTestTrait;

/**
 * @see \App\Http\Controllers\Management\UserController
 */
class UserControllerTest extends TestCase
{
    use RefreshDatabase, FeatureTestTrait;

    /**
     * INDEX
     * Assert that user cannot access the users page.
     *
     * @test
     */
    public function test_view_all_users_cannot_be_accessed_by_unauthorized_users()
    {
        $this->unauthorized_user()->get(route('management.users.index'))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * INDEX
     * Assert that user can access the users page.
     *
     * @test
     */
    public function test_view_all_users_can_be_accessed_by_authorized_users()
    {
        $response = $this->authorized_user(['user-read'])->get(route('management.users.index'))->assertOk();

        $this->assertAuthenticated();
        $response->assertViewIs('backend.management.users.index');
        $response->assertViewHas('data');
        $response->assertViewHas('organization');
    }

    /**
     * VIEW / SHOW
     * Assert that user cannot access the specific user page.
     *
     * @test
     */
    public function test_show_user_cannot_be_accessed_by_unauthorized_users()
    {
        $user = User::factory()->create();

        $this->unauthorized_user()->get(route('management.users.show', [$user]))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * VIEW / SHOW
     * Assert that user can access the specific user page.
     *
     * @test
     */
    public function test_show_user_can_be_accessed_by_authorized_users()
    {
        $user = User::factory()->create();

        $response = $this->authorized_user(['user-read'])->get(route('management.users.show', [$user]));

        $response->assertOk();
        $response->assertViewIs('backend.management.users.show');
        $response->assertViewHas('user', $user);
    }

    /**
     * CREATE
     * Assert that user cannot access the create user page.
     *
     * @test
     */
    public function test_create_user_cannot_be_accessed_by_unauthorized_users()
    {
        $this->unauthorized_user()->get(route('management.users.create'))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * CREATE
     * Assert that user can access the create user page.
     *
     * @test
     */
    public function test_create_user_can_be_accessed_by_authorized_users()
    {
        $organizations = Organization::factory()->times(3)->create();

        $response = $this->authorized_user(['user-create'])->get(route('management.users.create'));

        $this->assertAuthenticated();
        $response->assertOk();
        $response->assertViewIs('backend.management.users.create');
        $response->assertViewHas('roles');
        $response->assertViewHas('organizations', $organizations);
        $response->assertViewHas('raceTeams');
    }

    /**
     * EDIT
     * Assert that user cannot access the edit user page.
     *
     * @test
     */
    public function test_edit_user_cannot_be_accessed_by_unauthorized_users()
    {
        $user = User::factory()->create();
        $this->unauthorized_user()->get(route('management.users.edit', $user))->assertForbidden();
    }

    /**
     * EDIT
     * Assert that user can access the edit user page.
     *
     * @test
     */
    public function test_edit_user_can_be_accessed_by_authorized_users()
    {
        $user = User::factory()->create();
        $organizations = Organization::factory()->times(3)->create();
        $raceTeams = RaceTeam::factory()->times(3)->create();

        $response = $this->authorized_user(['user-update'])->get(route('management.users.edit', $user))->assertOk();

        $this->assertAuthenticated();
        $response->assertViewIs('backend.management.users.edit');

        $response->assertViewHas('user', $user);
        $response->assertViewHas('roles');
        $response->assertViewHas('organizations', $organizations);
        $response->assertViewHas('raceTeams', $raceTeams);
    }

    /**
     * UPDATE
     * Assert that user cannot update a user.
     *
     * @test
     */
    public function test_update_user_cannot_be_updated_by_unauthorized_users()
    {
        $user = User::factory()->create();

        $response = $this->unauthorized_user()->put(route('management.users.update', $user), [
            'name' => 'Test',
            'email' => 'test@test.com',
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('users', $user->toArray());
    }

    /**
     * UPDATE
     * Assert that user can update a user.
     *
     * @test
     */
    public function test_update_user_can_be_updated_by_authorized_users()
    {
        $user = User::factory()->create();

        $response = $this->authorized_user(['user-update'])->put(route('management.users.update', $user), [
            'name' => 'Test',
            'email' => 'test@test.com',
            'roles' => ['racer'],
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            'name' => 'Test',
            'email' => 'test@test.com',
        ]);
    }

    /**
     * DELETE / DESTROY
     * Assert that user cannot delete a user.
     *
     * @test
     */
    public function test_delete_user_cannot_be_deleted_by_unauthorized_users()
    {
        $user = User::factory()->create();

        $response = $this->unauthorized_user()->delete(route('management.users.destroy', $user));

        $response->assertStatus(403);
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    /**
     * DELETE / DESTROY
     * Assert that user can delete a user.
     *
     * @test
     */
    public function test_delete_user_can_be_deleted_by_authorized_users()
    {
        $user = User::factory()->create();

        $response = $this->authorized_user(['user-delete'])->delete(route('management.users.destroy', $user));

        $this->assertAuthenticated();
        $response->status(302);
        $response->assertRedirect(route('management.users.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('users', $user->toArray());
    }

    /**
     * SUSPEND
     * Assert that user cannot suspend a user.
     *
     * @test
     */
    public function test_suspend_user_cannot_be_suspended_by_unauthorized_users()
    {
        $user = User::factory()->create();

        $response = $this->unauthorized_user()->patch(route('management.suspend_user', $user));

        $this->assertAuthenticated();
        $response->assertStatus(403);
        $this->assertDatabaseHas('users', [
            'email' => $user->email,
            'suspended_until' => null,
        ]);
    }

    /**
     * SUSPEND
     * Assert that user can suspend a user.
     *
     * @test
     */
    public function test_suspend_user_can_be_suspended_by_authorized_users()
    {
        $user = User::factory()->create();

        $response = $this->authorized_user(['user-delete'])->patch(route('management.suspend_user', $user), [
            'suspended_until' => '2021-01-01',
        ]);

        $this->assertAuthenticated();
        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            'email' => $user->email,
            'suspended_until' => '2021-01-01 00:00:00',
        ]);
    }
}
