<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LoginSecurityController
 */
class LoginSecurityControllerTest extends TestCase
{
    /**
     * @test
     */
    public function disable2fa_returns_an_ok_response()
    {
        $response = $this->post(route('disable2fa'), [
            // TODO: send request data
        ]);

        $response->assertRedirect('profile#authentication');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function enable2fa_returns_an_ok_response()
    {
        $response = $this->post(route('enable2fa'), [
            // TODO: send request data
        ]);

        $response->assertRedirect('profile#authentication');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function generate2fa_secret_returns_an_ok_response()
    {
        $response = $this->post(route('generate2faSecret'), [
            // TODO: send request data
        ]);

        $response->assertRedirect('profile#authentication');

        // TODO: perform additional assertions
    }

    // test cases...
}
