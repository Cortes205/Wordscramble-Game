<?php
/**
 * Controller to handle and validate requests for Users
 * 
 * @author      Alan Cortes
 * @version     1.0.0
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

/**
 * Route: /jax/user
 */
class UserController extends Controller {

    private UserService $service;

    public function __construct() {
        $this->service = new UserService();
    }

    /**
     * Route: /login - Authenticate the user and their inputted credentials
     * 
     * @param Request $request
     * 
     * @return array
     */
    public function login(Request $request) {
        $csrfToken = $request->get("_csrfToken", "");
        $credentials = $request->get("credentials", []);

        $this->validateCsrf($csrfToken);

        $output = $this->service->login($credentials);
        $request->session()->regenerate();
        return $this->response($output, "User authenticated");
    }

    /**
     * Route: /register - Register and log in a user
     * 
     * @param Request $request
     * 
     * @return array
     */
    public function register(Request $request) {
        $csrfToken = $request->get("_csrfToken", "");
        $credentials = $request->get("credentials", []);

        $this->validateCsrf($csrfToken);

        $output = $this->service->register($credentials);
        $request->session()->regenerate();
        return $this->response($output, "User registered and logged in");
    }

    /**
     * Route: /logout - Log the current user out
     * 
     * @param Request $request
     * 
     * @return array
     */
    public function logout(Request $request) {
        $csrfToken = $request->get("_csrfToken", "");
        $this->validateCsrf($csrfToken);

        $output = $this->service->logout();
        $request->session()->regenerate();
        return $this->response($output);
    }
}