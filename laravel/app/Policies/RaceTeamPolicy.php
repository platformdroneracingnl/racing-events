<?php

namespace App\Policies;

use App\Models\RaceTeam;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RaceTeamPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user): bool
    {
        // For index method in controller
        if ($user->hasPermissionTo('race_team-read')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RaceTeam  $raceTeam
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, RaceTeam $raceTeam): bool
    {
        // For show method in controller
        if ($user->hasPermissionTo('race_team-read')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user): bool
    {
        if ($user->hasPermissionTo('race_team-create')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RaceTeam  $raceTeam
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, RaceTeam $raceTeam): bool
    {
        if ($user->hasPermissionTo('race_team-update')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RaceTeam  $raceTeam
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, RaceTeam $raceTeam): bool
    {
        if ($user->hasPermissionTo('race_team-delete')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RaceTeam  $raceTeam
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, RaceTeam $raceTeam): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RaceTeam  $raceTeam
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, RaceTeam $raceTeam): bool
    {
        //
    }
}
