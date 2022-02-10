<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProfileController
 */
class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function destroy_user_returns_an_ok_response()
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->delete(route('profile.destroy', [$user]));

        $response->assertRedirect('/');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function password_returns_an_ok_response()
    {
        $response = $this->put(route('profile.password'), [
            // TODO: send request data
        ]);

        $response->assertOk();

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function password_validates_with_a_form_request()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProfileController::class,
            'password',
            \App\Http\Requests\PasswordRequest::class
        );
    }

    /**
     * @test
     */
    public function show_returns_an_ok_response()
    {
        $organization = \App\Models\Organization::factory()->create();
        $registrations = \App\Models\Registration::factory()->times(3)->create();
        $countries = \App\Models\Country::factory()->times(3)->create();

        $response = $this->get(route('profile.show'));

        $response->assertOk();
        $response->assertViewIs('backend.profile.show');
        $response->assertViewHas('lang');
        $response->assertViewHas('data');
        $response->assertViewHas('countries', $countries);
        $response->assertViewHas('organization', $organization);
        $response->assertViewHas('age');
        $response->assertViewHas('registrations', $registrations);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function store_avatar_returns_an_ok_response()
    {
        $response = $this->post(route('profile.avatar'), [
            // TODO: send request data
        ]);

        $response->assertOk();

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function update_returns_an_ok_response()
    {
        $response = $this->put(route('profile.update'), [
            // TODO: send request data
        ]);

        $response->assertOk();

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function update_validates_with_a_form_request()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProfileController::class,
            'update',
            \App\Http\Requests\ProfileRequest::class
        );
    }

    // test cases...
}
