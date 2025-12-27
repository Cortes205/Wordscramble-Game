<?php
/**
 * Policy for permission checking Notifcation CRUD
 * 
 * @author      Alan Cortes
 * @version     1.0.0
 */

namespace App\Policies;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NotificationPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Notification $notification)
    {
        return $user->id === $notification->fk_user_id ?
            Response::allow() : Response::deny("Unable to update a notification that isn't yours");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Notification $notification)
    {
        return $user->id === $notification->fk_user_id ?
            Response::allow() : Response::deny("Unable to delete a notification that isn't yours");
    }
}
