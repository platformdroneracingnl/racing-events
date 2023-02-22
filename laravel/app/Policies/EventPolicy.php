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
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('event-read');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Event $event): bool
    {
        if ($user->hasRole('organizer')) {
            if ($user->id === $event->user_id and $user->hasPermissionTo('event-read')) {
                return true;
            }
        } elseif ($user->hasRole(['manager', 'supervisor'])) {
            if ($user->hasPermissionTo('event-read')) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('event-create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Event $event): bool
    {
        if ($user->hasRole('organizer')) {
            if ($user->id === $event->user_id and $user->hasPermissionTo('event-update')) {
                return true;
            }
        } elseif ($user->hasRole(['manager', 'supervisor'])) {
            if ($user->hasPermissionTo('event-update')) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Event $event): bool
    {
        if ($user->hasRole('organizer')) {
            if ($user->id === $event->user_id and $user->hasPermissionTo('event-delete')) {
                return true;
            }
        } elseif ($user->hasRole(['manager', 'supervisor'])) {
            if ($user->hasPermissionTo('event-delete')) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Event $event): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Event $event): bool
    {
        return false;
    }

    /**
     * Determine whether the use can view the event registrations.
     */
    public function registration(User $user, Event $event): bool
    {
        return $user->id === $event->user_id || $user->hasPermissionTo('event-registrations');
    }

    /**
     * Determine whether the use can view the checkin page.
     */
    public function checkin(User $user, Event $event): bool
    {
        return $user->id === $event->user_id || $user->hasPermissionTo('event-checkin');
    }
}
