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

    public function __construct()
    {
        $this->service = new UserService();
    }

    /**
     * Route: /profile - Get the current user's profile
     * 
     * @param int $userId
     * 
     * @return array
     */
    public function profile()
    {
        $user = $this->getUser();
        $output = $this->service->profile($user);
        return $this->response($output, "User's profile retrieved");
    }

    /**
     * Route: /login - Authenticate the user and their inputted credentials
     * 
     * @param Request $request
     * 
     * @return array
     */
    public function login(Request $request)
    {
        $credentials = $request->get("credentials", []) ?? [];

        $output = $this->service->login($credentials);
        $request->session()->regenerate();
        $request->session()->regenerateToken();
        return $this->response($output, "User authenticated");
    }

    /**
     * Route: /register - Register and log in a user
     * 
     * @param Request $request
     * 
     * @return array
     */
    public function register(Request $request)
    {
        $credentials = $request->get("credentials", []) ?? [];

        $output = $this->service->register($credentials);
        $request->session()->regenerate();
        $request->session()->regenerateToken();
        return $this->response($output, "User registered and logged in");
    }

    /**
     * Route: /logout - Log the current user out
     * 
     * @param Request $request
     * 
     * @return array
     */
    public function logout(Request $request)
    {
        $output = $this->service->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $this->response($output);
    }
}