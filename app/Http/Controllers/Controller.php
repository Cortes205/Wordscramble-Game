<?php
/**
 * BaseController that all controllers should extend
 * 
 * @author      Alan Cortes
 * @version     1.0.0
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    /**
     * Create a centralized formatted response for the front end
     * 
     * @param array $data
     * @param string $message
     * 
     * @return array
     */
    protected function response(array $data, string $message = "") {
        return [
            "message" => $message,
            "data" => $data,
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

    /**
     * Validate the passed CSRF Token
     * 
     * @param string $csrfToken
     * 
     * @throws TokenMismatchException
     * @return void
     */
    protected function validateCsrf(string $csrfToken) {
        $token = csrf_token();

        if ($csrfToken !== $token) {
            throw new TokenMismatchException("CSRF token mismatch");
        }
    }
}
