<?php
/**
 * Routes for serving pages
 */

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get("/", function () {
    /**
     * @var User
     */
    $user = Auth::getUser();
    if ($user) {
        return Inertia::render("dashboard");
    }
    return Inertia::render("home");
})->name('home');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
