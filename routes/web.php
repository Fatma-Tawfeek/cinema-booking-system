<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ActorController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\CinemaController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TimeslotController;

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

Route::get('/', function () {
    return view('welcome');
});

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
});

Route::get('/admin/login', [AdminController::class, 'getLoginPage']);
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');

require __DIR__ . '/auth.php';
