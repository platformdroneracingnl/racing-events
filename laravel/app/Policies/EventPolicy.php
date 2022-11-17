<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('event-read');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Event $event)
    {
        if ($user->hasRole('organizer')) {
            if ($user->id === $event->user_id and $user->hasPermissionTo('event-read')) {
                return true;
            }
        } elseif ($user->hasRole(['manager','supervisor'])) {
            if ($user->hasPermissionTo('event-read')) {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if ($user->hasPermissionTo('event-create')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Event $event)
    {
        if ($user->hasRole('organizer')) {
            if ($user->id === $event->user_id and $user->hasPermissionTo('event-update')) {
                return true;
            }
        } elseif ($user->hasRole(['manager', 'supervisor'])) {
            if ($user->hasPermissionTo('event-update')) {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Event $event)
    {
        if ($user->hasRole('organizer')) {
            if ($user->id === $event->user_id and $user->hasPermissionTo('event-delete')) {
                return true;
            }
        } elseif ($user->hasRole(['manager', 'supervisor'])) {
            if ($user->hasPermissionTo('event-delete')) {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Event $event)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Event $event)
    {
        //
    }

    public function registration(User $user, Event $event)
    {
        if ($user->id === $event->user_id || $user->hasPermissionTo('event-registrations')) {
            return true;
        }
    }

    public function checkin(User $user, Event $event)
    {
        if ($user->id === $event->user_id || $user->hasPermissionTo('event-checkin')) {
            return true;
        }
    }
}
