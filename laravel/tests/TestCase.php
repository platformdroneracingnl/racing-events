<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use JMac\Testing\Traits\AdditionalAssertions;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, AdditionalAssertions, RefreshDatabase;

    public User $pilot;

    public User $organizer;

    public User $manager;

    public User $supervisor;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed', ['--class' => 'PermissionTableSeeder']);

        $this->pilot = $this->createUser('racer');
        $this->organizer = $this->createUser('organizer');
        $this->manager = $this->createUser('manager');
        $this->supervisor = $this->createUser('supervisor');
    }

    /**
     * Private functions to create a user.
     */
    private function createUser($user_type): User
    {
        $user = User::factory()->create();

        return $user->assignRole($user_type);
    }
}
