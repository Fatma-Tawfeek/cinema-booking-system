<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ActorController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\CinemaController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\TimeslotController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/movies/{movie}', [HomeController::class, 'show'])->name('movies.show');

// Admin Routes
Route::group([
    'middleware' => ['auth', 'roles:admin'],
    'prefix' => 'admin',
    'as' => 'admin.',
], function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // Category Routes
    Route::resource('categories', CategoryController::class);
    // Actors Routes
    Route::resource('actors', ActorController::class);
    // Movie Routes
    Route::resource('movies', MovieController::class);
    // Cinema Routes
    Route::resource('cinemas', CinemaController::class);
    // Cinema Timeslots Routes
    Route::resource('timeslots', TimeslotController::class);
    // Cinema Movies Schedule Routes
    Route::resource('schedules', ScheduleController::class);
    Route::get('schedules/{cinema}/timeslots', [ScheduleController::class, 'timeslots'])->name('schedules.timeslots');
    // Bookings Routes
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::delete('/bookings/{booking}/cancel', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminController::class, 'getLoginPage']);
    Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
});

require __DIR__ . '/auth.php';
