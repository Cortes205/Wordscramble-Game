<?php
/**
 * Controller for Notification requests
 * 
 * @author      Alan Cortes
 * @version     1.0.0
 */

namespace App\Http\Controllers;

use App\Http\Services\NotificationService;
use Illuminate\Http\Request;

/**
 * Route: /notification
 */
class NotificationController extends Controller
{

    private NotificationService $service;

    public function __construct() {
        $this->service = new NotificationService();
    }

    /**
     * Route: /user - GET - Get the user's notifications
     *      (the ones that aren't 'hidden')
     * 
     * @return array
     */
    public function getUserNotifications(Request $request) {
        $limit = $request->get("limit", 5) ?? 5;

        $user = $this->getUser();
        $output = $this->service->getUserNotifications($user, $limit);
        return $this->response($output, "Notifications retrieved");
    }

    /**
     * Route: /hide - PUT - Update a given or all unhidden notifications
     *      to be hidden
     * 
     * @param Request $request
     * 
     * @return array
     */
    public function hideNotifications(Request $request) {
        $id = $request->get("id", 0) ?? 0;

        $user = $this->getUser();
        $this->service->hideNotifications($user,$id);
        return $this->response([], "Notifications hidden");
    }
}
