<?php
/**
 * Routes for local jax requests
 */

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::prefix("/jax")->group(function () {
    // guest JAX requests
    Route::middleware("guest")->group(function() {
        // User
        Route::prefix("/user")->group(function() {
            Route::post("/login", [UserController::class, "login"]);
            Route::post("/register", [UserController::class, "register"]);
        });
    });

    // auth'd JAX requests
    Route::middleware("auth")->group(function () {
        // User
        Route::prefix("/user")->group(function () {
            Route::get("/profile", [UserController::class, "profile"]);
            Route::post("/logout", [UserController::class, "logout"]);
        });

        // Notification
        Route::prefix("/notification")->group(function () {
            Route::get("/user", [NotificationController::class, "getUserNotifications"]);
            Route::put("/hide", [NotificationController::class, "hideNotifications"]);
        });
    });
});
