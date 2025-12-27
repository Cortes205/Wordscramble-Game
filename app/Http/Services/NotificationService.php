<?php
/**
 * Notification service for Notification CRUD and queries
 * 
 * @author      Alan Cortes
 * @version     1.0.0
 */

namespace App\Http\Services;

use App\Http\Resources\NotificationResource;
use App\Models\User;
use App\Models\Notification;
use Gate;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NotificationService
{   
    const NOTI_TYPE_MSG = "msg";
    const NOTI_TYPE_ERR = "error";

    /**
     * Get the user notifications (the ones that aren't 'hidden')
     * 
     * @param User $user
     * @param int $limit How many are allowed per page
     * 
     * @return array|AnonymousResourceCollection
     */
    public function getUserNotifications(User $user, int $limit)
    {
        $limit = $limit > 0 ? $limit : 5;
        $notifications = NotificationResource::collection(
            Notification::ofUser($user)
                ->where("hidden", 0)
                ->orderBy("created_at", "desc")
                ->paginate($limit)
        );

        return $notifications;
    }

    /**
     * Hide given or all unhidden notifications from the user
     * 
     * @param User $user
     * @param int $id 0 for all or id of a notification
     * 
     * @return void
     */
    public function hideNotifications(User $user, int $id)
    {
        // If id isn't empty, get the notification of said id, otherwise get all the unhidden ones
        $notifications = $id ? Notification::ofId($id)
            : Notification::ofUser($user)
                ->where("hidden", 0);

        // Ensure all notifications are updateable by the current user
        foreach ($notifications->get() as $notification) {
            Gate::authorize("update-notification", $notification);
        }
        
        $notifications->update([
            "hidden" => 1,
            "updated_at" => (new \DateTime())->format("Y-m-d H:i:s")
        ]);
    }

    /**
     * Create a notification of a given type with a header and body
     * 
     * @param User $user
     * @param string $header
     * @param string $body
     * @param string $type @see consts at the top of this class
     * 
     * @return Notification
     */
    public function createNotification(User $user, string $header, string $body, string $type = self::NOTI_TYPE_MSG)
    {
        $notification = Notification::create([
            "fk_user_id" => $user->id,
            "type" => $type,
            "header" => $header,
            "body" => $body,
        ]);

        // TODO: broadcast the notification

        return $notification;
    }
}