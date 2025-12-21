<?php
/**
 * Routes for local jax requests
 */

use App\Http\Controllers\Auth\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix("/jax")->middleware("guest")->group(function() {
    Route::prefix("/user")->group(function() {
        Route::post("/login", [UserController::class, "login"]);
        Route::post("/register", [UserController::class, "register"]);
    });
});

Route::prefix("/jax")->middleware("auth")->group(function () {
    Route::prefix("/user")->group(function () {
        Route::post("/logout", [UserController::class, "logout"]);
    });
});