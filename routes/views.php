<?php
/**
 * Routes for serving pages
 */

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get("/", function () {
    if (Auth::check()) {
        return Inertia::render("dashboard");
    }
    return Inertia::render("home");
})->name('home');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
