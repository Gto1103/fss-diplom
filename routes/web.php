<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, 'form'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);

    Route::group(['middleware' => 'auth'], function () {
        Route::get('index', [AdminController::class, 'index'])->name('index');
        Route::post('add_hall', [HallController::class, 'addHall'])->name('addHall');
        Route::post('delete_hall/{id}', [HallController::class, 'deleteHall'])->name('deleteHall');
        Route::post('updatePrice/{hall}', [HallController::class, 'updatePrice'])->name('updatePrice');
        Route::post('updateSeats', [HallController::class, 'updateSeats'])->name('updateSeats');
        Route::post('add_movie', [MovieController::class, 'addMovie'])->name('addMovie');
        Route::post('delete_movie/{id}', [MovieController::class, 'deleteMovie'])->name('deleteMovie');
        Route::post('updateSeances', [SeanceController::class, 'updateSeances'])->name('updateSeances');
    });
});

Route::prefix('client')->group(function () {
    Route::get('index', [ClientController::class, 'index']);
    Route::get('hall/{id}', [ClientController::class, 'hall']);
    Route::get('payment/{id}', [ClientController::class, 'payment']);
    Route::get('ticket/{id}', [ClientController::class, 'ticket']);
});
