<?php

namespace Tests\Feature\Http\Controllers\Utils;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Utils\MollieController
 */
class MollieControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function check_payment_status_returns_an_ok_response()
    {
        $response = $this->get(route('payment.event', ['paymentID' => $paymentID]));

        $response->assertRedirect($payment->getCheckoutUrl());

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function mollie_handle_returns_an_ok_response()
    {
        $registration = \App\Models\Registration::factory()->create();
        $events = \App\Models\Event::factory()->times(3)->create();
        $users = \App\Models\User::factory()->times(3)->create();

        $response = $this->post(route('webhooks.mollie'), [
            // TODO: send request data
        ]);

        $response->assertOk();

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function payment_handler_returns_an_ok_response()
    {
        $registrations = \App\Models\Registration::factory()->times(3)->create();

        $response = $this->get(route('payment.handle', ['regID' => $regID]));

        $response->assertOk();
        $response->assertViewIs('payments.open');
        $response->assertViewHas('event');
        $response->assertViewHas('registration');
        $response->assertViewHas('expireAt');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function prepare_payment_returns_an_ok_response()
    {
        $response = $this->get(route('mollie.payment'));

        $response->assertRedirect($payment->getCheckoutUrl());

        // TODO: perform additional assertions
    }

    // test cases...
}
