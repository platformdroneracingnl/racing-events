<?php

namespace Tests\Feature\Http\Controllers\Pilots;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Pilots\RegistrationController
 */
class RegistrationControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function my_registrations_index_returns_an_ok_response()
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->get(route('registrations.index'));

        $response->assertOk();
        $response->assertViewIs('backend.pilots.registrations.index');
        $response->assertViewHas('lang');
        $response->assertViewHas('registrations');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function store_returns_an_ok_response()
    {
        $event = \App\Models\Event::factory()->create();
        $organizations = \App\Models\Organization::factory()->times(3)->create();
        $users = \App\Models\User::factory()->times(3)->create();

        $response = $this->post(route('registration.event.store', [$event]), [
            // TODO: send request data
        ]);

        $response->assertRedirect(back());

        // TODO: perform additional assertions
    }

    // test cases...
}
