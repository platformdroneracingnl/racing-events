<?php

namespace Tests\Feature\Http\Controllers\Organizator;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Organizator\WaiverController
 */
class WaiverControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {
        $user = \App\Models\User::factory()->create();
        $waivers = \App\Models\Waiver::factory()->times(3)->create();

        $response = $this->get(route('organizator.waivers.index'));

        $response->assertOk();
        $response->assertViewIs('backend.organizator.waivers.index');
        $response->assertViewHas('result');
        $response->assertViewHas('lang');

        // TODO: perform additional assertions
    }

    // test cases...
}
