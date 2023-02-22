<?php

namespace App\Policies;

use App\Models\RaceTeam;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RaceTeamPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view index method.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('race_team-read');
    }

    /**
     * Determine whether the user can view the show method.
     */
    public function view(User $user, RaceTeam $raceTeam): bool
    {
        return $user->hasPermissionTo('race_team-read');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('race_team-create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RaceTeam $raceTeam): bool
    {
        return $user->hasPermissionTo('race_team-update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RaceTeam $raceTeam): bool
    {
        return $user->hasPermissionTo('race_team-delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RaceTeam $raceTeam): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RaceTeam $raceTeam): bool
    {
        return false;
    }
}
