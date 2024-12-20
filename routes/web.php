<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Auth\Middleware\Authorize;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    // Routes accessible to both logged-in users and admins
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    // Edit profile route
    Route::get('/profile/{user}/edit', [UserController::class, 'edit'])->name('profile.edit');

    // Update profile route
    Route::patch('/profile/{user}', [UserController::class, 'update'])->name('profile.update');
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    
    // Admin-specific routes
    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');
        Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::patch('/events/{event}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    });

    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
    Route::post('/events/{event}/register', [EventController::class, 'register'])->name('events.register');

    // User-specific routes (optional, based on requirements)
    Route::middleware([UserMiddleware::class])->group(function () {
        
    });
});
