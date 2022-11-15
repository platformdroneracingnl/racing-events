<?php

namespace App\Traits;

use App\Models\User;

trait FeatureTestTrait
{
    /**
     * Create a user without any permissions.
     */
    public function unauthorized_user()
    {
        $user = User::factory()->create();

        return $this->actingAs($user);
    }

    /**
     * Create a user with permissions.
     *
     * @param  array  $permissions
     */
    public function authorized_user(array $permission)
    {
        $user = User::factory()->create();
        $user->givePermissionTo($permission);

        return $this->actingAs($user);
    }
}