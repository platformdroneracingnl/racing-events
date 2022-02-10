<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\NotificationsController
 */
class NotificationsControllerTest extends TestCase
{
    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {
        $response = $this->get(route('notify.index'));

        $response->assertOk();
        $response->assertViewIs('backend.notifications.index');
        $response->assertViewHas('notifications');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function read_returns_an_ok_response()
    {
        $response = $this->get(route('notify.read', ['id' => $id]));

        $response->assertRedirect(back());

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function read_all_returns_an_ok_response()
    {
        $response = $this->get(route('notify.readAll'));

        $response->assertRedirect(back());

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function remove_returns_an_ok_response()
    {
        $response = $this->delete(route('notify.remove', ['id' => $id]));

        $response->assertRedirect(back());

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function remove_all_returns_an_ok_response()
    {
        $response = $this->get(route('notify.removeAll'));

        $response->assertRedirect(back());

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function show_returns_an_ok_response()
    {
        $response = $this->get(route('notify.show', ['id' => $id]));

        $response->assertRedirect($notification->data['url']);

        // TODO: perform additional assertions
    }

    // test cases...
}
