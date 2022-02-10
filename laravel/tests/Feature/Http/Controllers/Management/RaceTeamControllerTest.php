<?php

namespace Tests\Feature\Http\Controllers\Management;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Management\RaceTeamController
 */
class RaceTeamControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create_returns_an_ok_response()
    {
        $response = $this->get(route('management.race_teams.create'));

        $response->assertOk();
        $response->assertViewIs('backend.management.race_teams.create');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function destroy_returns_an_ok_response()
    {
        $raceTeam = \App\Models\RaceTeam::factory()->create();

        $response = $this->delete(route('management.race_teams.destroy', ['raceteam' => $raceTeam->raceteam]));

        $response->assertRedirect(route('management.race_teams.index'));
        $this->assertDeleted($raceteam);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function edit_returns_an_ok_response()
    {
        $raceTeam = \App\Models\RaceTeam::factory()->create();

        $response = $this->get(route('management.race_teams.edit', ['raceteam' => $raceTeam->raceteam]));

        $response->assertOk();
        $response->assertViewIs('backend.management.race_teams.edit');
        $response->assertViewHas('raceteam');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {
        $raceTeams = \App\Models\RaceTeam::factory()->times(3)->create();

        $response = $this->get(route('management.race_teams.index'));

        $response->assertOk();
        $response->assertViewIs('backend.management.race_teams.index');
        $response->assertViewHas('race_teams');
        $response->assertViewHas('lang');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function show_returns_an_ok_response()
    {
        $raceTeam = \App\Models\RaceTeam::factory()->create();

        $response = $this->get(route('management.race_teams.show', ['raceteam' => $raceTeam->raceteam]));

        $response->assertOk();
        $response->assertViewIs('backend.management.race_teams.show');
        $response->assertViewHas('raceteam');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function store_returns_an_ok_response()
    {
        $response = $this->post(route('management.race_teams.store'), [
            // TODO: send request data
        ]);

        $response->assertRedirect(route('management.race_teams.index'));

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function update_returns_an_ok_response()
    {
        $raceTeam = \App\Models\RaceTeam::factory()->create();

        $response = $this->put(route('management.race_teams.update', ['raceteam' => $raceTeam->raceteam]), [
            // TODO: send request data
        ]);

        $response->assertRedirect(route('management.race_teams.index'));

        // TODO: perform additional assertions
    }

    // test cases...
}
