<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\LoginController;
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
        Route::post('add_hall', [HallController::class, 'create'])->name('addHall');
        Route::post('delete_hall/{id}', [HallController::class, 'deleteHall'])->
        name('deleteHall');
        Route::post('halls/updatePrice/{hall}', [HallController::class, 'updatePrice'])
        ->middleware('admin')->name('updatePrice');
    });
});
