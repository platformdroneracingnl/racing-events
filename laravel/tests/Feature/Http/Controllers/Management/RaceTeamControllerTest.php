<?php

namespace Tests\Feature\Http\Controllers\Management;

use App\Models\RaceTeam;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Management\RaceTeamController
 */
class RaceTeamControllerTest extends TestCase
{
    use RefreshDatabase, FeatureTestTrait;

    /**
     * INDEX
     * Assert that user cannot access the management raceteam page.
     *
     * @test
     */
    public function test_view_all_raceteams_cannot_be_accessed_by_unauthorized_users()
    {
        $this->unauthorized_user()->get(route('management.race_teams.index'))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * INDEX
     * Assert that user can access the management raceteam page.
     *
     * @test
     */
    public function test_view_all_raceteams_can_be_accessed_by_authorized_users()
    {
        $response = $this->authorized_user(['race_team-read'])->get(route('management.race_teams.index'))->assertOk();

        $this->assertAuthenticated();
        $response->assertViewIs('backend.management.race_teams.index');
        $response->assertViewHas('race_teams');
        $response->assertViewHas('lang');
    }

    /**
     * VIEW / SHOW
     * Assert that user cannot access the specific raceteam page.
     *
     * @test
     */
    public function test_show_raceteam_cannot_be_accessed_by_unauthorized_users()
    {
        $raceteam = RaceTeam::factory()->create();

        $this->unauthorized_user()->get(route('management.race_teams.show', $raceteam->id))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * VIEW / SHOW
     * Assert that user can access the specific raceteam page.
     *
     * @test
     */
    public function test_show_raceteam_can_be_accessed_by_authorized_users()
    {
        $raceteam = RaceTeam::factory()->create();

        $response = $this->authorized_user(['race_team-read'])->get(route('management.race_teams.show', $raceteam->id))->assertOk();

        $this->assertAuthenticated();
        $response->assertViewIs('backend.management.race_teams.show');
        $response->assertViewHas('raceteam');
    }

    /**
     * CREATE
     * Assert that user cannot access the create raceteam page.
     *
     * @test
     */
    public function test_create_raceteam_cannot_be_accessed_by_unauthorized_users()
    {
        $this->unauthorized_user()->get(route('management.race_teams.create'))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * CREATE
     * Assert that user can access the create raceteam page.
     *
     * @test
     */
    public function test_create_raceteam_can_be_accessed_by_authorized_users()
    {
        $response = $this->authorized_user(['race_team-create'])->get(route('management.race_teams.create'))->assertOk();

        $this->assertAuthenticated();
        $response->assertViewIs('backend.management.race_teams.create');
    }

    /**
     * STORE
     * Assert that user cannot store a new raceteam.
     *
     * @test
     */
    public function test_store_new_raceteam_cannot_by_unauthorized_users()
    {
        $raceteam = RaceTeam::factory()->make();

        $this->unauthorized_user()->post(route('management.race_teams.store'), $raceteam->toArray())->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * STORE
     * Assert that user can store a new raceteam.
     *
     * @test
     */
    public function test_store_new_raceteam_can_by_authorized_users()
    {
        $raceteam = RaceTeam::factory()->make();

        $response = $this->authorized_user(['race_team-create'])->post(route('management.race_teams.store'), $raceteam->toArray())->assertRedirect();

        $this->assertAuthenticated();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('race_teams', [
            'name' => $raceteam->name,
        ]);
    }

    /**
     * EDIT
     * Assert that user cannot access the edit raceteam page.
     *
     * @test
     */
    public function test_edit_raceteam_cannot_be_accessed_by_unauthorized_users()
    {
        $raceteam = RaceTeam::factory()->create();

        $this->unauthorized_user()->get(route('management.race_teams.edit', $raceteam->id))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * EDIT
     * Assert that user can access the edit raceteam page.
     *
     * @test
     */
    public function test_edit_raceteam_can_be_accessed_by_authorized_users()
    {
        $raceteam = RaceTeam::factory()->create();

        $response = $this->authorized_user(['race_team-update'])->get(route('management.race_teams.edit', $raceteam->id))->assertOk();

        $this->assertAuthenticated();
    }

    /**
     * UPDATE
     * Assert that user cannot update the raceteam.
     *
     * @test
     */
    public function test_update_raceteam_cannot_by_unauthorized_users()
    {
        $raceteam = RaceTeam::factory()->create();

        $this->unauthorized_user()->put(route('management.race_teams.update', $raceteam->id), $raceteam->toArray())->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * UPDATE
     * Assert that user can update the raceteam.
     *
     * @test
     */
    public function test_update_raceteam_can_by_authorized_users()
    {
        $raceteam = RaceTeam::factory()->create();

        $response = $this->authorized_user(['race_team-update'])->get(route('management.race_teams.edit', $raceteam->id))->assertOk();

        $this->assertAuthenticated();
        $response->assertViewIs('backend.management.race_teams.edit');
        $response->assertViewHas('raceteam', $raceteam);
    }

    /**
     * DESTROY / DELETE
     * Assert that user cannot delete the raceteam.
     *
     * @test
     */
    public function test_destroy_raceteam_cannot_by_unauthorized_users()
    {
        $raceteam = RaceTeam::factory()->create();

        $this->unauthorized_user()->delete(route('management.race_teams.destroy', $raceteam->id))->assertForbidden();
        $this->assertAuthenticated();
    }

    /**
     * DESTROY / DELETE
     * Assert that user can delete the raceteam.
     *
     * @test
     */
    public function test_destroy_raceteam_can_by_authorized_users()
    {
        $raceteam = RaceTeam::factory()->create();

        $response = $this->authorized_user(['race_team-delete'])->delete(route('management.race_teams.destroy', $raceteam->id))->assertRedirect();

        $this->assertAuthenticated();
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('race_teams', $raceteam->toArray());
    }
}
