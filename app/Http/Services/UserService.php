<?php
/**
 * Service that handles User CRUD & Queries
 * 
 * @author      Alan Cortes
 * @version     1.0.0
 */

namespace App\Http\Services;

use App\Http\Resources\StatCategoryResource;
use App\Models\StatCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Exception;

class UserService {

    /**
     * Get the given user's profile
     * 
     * @param User $user
     * 
     * @return array
     */
    public function profile(User $user) {
        $stats = StatCategoryResource::collection(
            StatCategory::with("latestUserStat")
                ->orderBy("created_at", "desc")
                ->get()
        );

        return [
            "stats" => $stats,
            "settings" => [],
        ];
    }

    /**
     * Log in the user based on credentials
     * 
     * @param array $formData Credentials
     * 
     * @throws AccessDeniedHttpException No user found or incorrect password
     * @return array
     */
    public function login(array $formData) {
        $this->validateLoginData($formData);

        $username = $formData["username"];

        $user = User::where([
            "name" => $username,
        ])->first();

        if (!$user || $this->decrypt($user->password) !== $formData["password"]) {
            throw new AccessDeniedHttpException("Username or password is incorrect");
        }

        Auth::login($user);

        return [];
    }
    
    /**
     * Register and log in a user with the given credentials
     * 
     * @param array $formData Credentials
     * 
     * @throws BadRequestHttpException User already exists
     * @return array
     */
    public function register(array $formData) {
        $this->validateRegisterData($formData);

        $username = $formData["username"];

        $user = User::where([
            "name" => $username,
        ])->first();

        if ($user) {
            throw new BadRequestHttpException("User of name $username already exists");
        }

        $user = User::create([
            "name" => $username,
            "password" => Crypt::encrypt($formData["password"])
        ]);

        Auth::login($user);
        
        return [];
    }

    /**
     * Log out the current user
     * 
     * @return array
     */
    public function logout() {
        Auth::logout();
        return [];
    }

    /**
     * Validate data passed to the login service
     * 
     * @param array $formData Credentials
     * 
     * @throws NotAcceptableHttpException Missing info
     * @return void
     */
    private function validateLoginData(array $formData) {
        if (!isset($formData["username"]) || empty($formData["username"])) {
            throw new NotAcceptableHttpException("Username cannot be empty");
        }

        if (!isset($formData["password"]) || empty($formData["password"])) {
            throw new NotAcceptableHttpException("Password cannot be empty");
        }
    }

    /**
     * Validate data passed to the register service
     * 
     * @param array $formData Credentials
     * 
     * @throws NotAcceptableHttpException Missing info/non-matching passwords
     * @return void
     */
    private function validateRegisterData(array $formData) {
        $this->validateLoginData($formData);

        if (!isset($formData["confirmPassword"]) || empty($formData["confirmPassword"]) || $formData["password"] !== $formData["confirmPassword"]) {
            throw new NotAcceptableHttpException("Inputted passwords must match");
        }
    }

    /**
     * Attempt to decrypt a given string
     * 
     * @param string $encrypted
     * 
     * @return string Decrypted or same string
     */
    private function decrypt(string $encrypted) {
        try {
            return Crypt::decrypt($encrypted);
        } catch (Exception $ex) {
            return $encrypted;
        }
    }
}