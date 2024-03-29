<?php

namespace Tests\Feature\Http\Controllers\Organizator;

use Illuminate\Foundation\Testing\RefreshDatabase;
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
    public function index_returns_an_ok_response(): void
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

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
