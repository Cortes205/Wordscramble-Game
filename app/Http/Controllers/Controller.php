<?php
/**
 * BaseController that all controllers should extend
 * 
 * @author      Alan Cortes
 * @version     1.0.0
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    /**
     * Create a centralized formatted response for the front end
     * 
     * @param array|AnonymousResourceCollection $data
     * @param string $message
     * 
     * @return array
     */
    protected function response(array|AnonymousResourceCollection $data = [], string $message = "") {
        return [
            "message" => $message,
            "response" => $data,
        ];
    }

    /**
     * Get the current logged in user
     * 
     * @return User
     */
    protected function getUser() {
        /**
         * @var User
         */
        $user = Auth::getUser();
        return $user;
    }
}
