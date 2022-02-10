<?php

namespace Tests\Feature\Http\Controllers\Organizator;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Organizator\RegistrationController
 */
class RegistrationControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function change_multiple_registration_returns_an_ok_response()
    {
        $registration = \App\Models\Registration::factory()->create();
        $event = \App\Models\Event::factory()->create();
        $status = \App\Models\Status::factory()->create();

        $response = $this->patch(route('event.registrations.update-all'), [
            // TODO: send request data
        ]);

        $response->assertRedirect(back());

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function checkin_returns_an_ok_response()
    {
        $registration = \App\Models\Registration::factory()->create();
        $registrations = \App\Models\Registration::factory()->times(3)->create();

        $response = $this->get(route('event.check-in', [$registration]));

        $response->assertOk();
        $response->assertViewIs('backend.organizator.events.checkin');
        $response->assertViewHas('registration', $registration);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function destroy_registration_returns_an_ok_response()
    {
        $registration = \App\Models\Registration::factory()->create();

        $response = $this->post(route('organizator.registration.destroy', [$registration]), [
            // TODO: send request data
        ]);

        $response->assertRedirect(back());

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function event_registrations_returns_an_ok_response()
    {
        $event = \App\Models\Event::factory()->create();
        $registrations = \App\Models\Registration::factory()->times(3)->create();
        $statuses = \App\Models\Status::factory()->times(3)->create();

        $response = $this->get(route('organizator.event.registrations', [$event]));

        $response->assertOk();
        $response->assertViewIs('backend.organizator.events.registrations');
        $response->assertViewHas('event', $event);
        $response->assertViewHas('registrationStatus');
        $response->assertViewHas('lang');
        $response->assertViewHas('registrations', $registrations);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function export_p_d_f_returns_an_ok_response()
    {
        $event = \App\Models\Event::factory()->create();
        $registrations = \App\Models\Registration::factory()->times(3)->create();

        $response = $this->get(route('organizator.event.export', [$event]));

        $response->assertOk();

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function scan_returns_an_ok_response()
    {
        $response = $this->get(route('event.scan'));

        $response->assertOk();
        $response->assertViewIs('backend.organizator.scan');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function update_checkin_returns_an_ok_response()
    {
        $registration = \App\Models\Registration::factory()->create();

        $response = $this->patch(route('event.check-in.update', [$registration]), [
            // TODO: send request data
        ]);

        $response->assertRedirect(route('event.scan'));

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function update_registration_returns_an_ok_response()
    {
        $registration = \App\Models\Registration::factory()->create();
        $event = \App\Models\Event::factory()->create();
        $status = \App\Models\Status::factory()->create();

        $response = $this->patch(route('event.registration.update', [$registration]), [
            // TODO: send request data
        ]);

        $response->assertRedirect(back());

        // TODO: perform additional assertions
    }

    // test cases...
}
