<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class,'index']);

Route::get('/logout', [\App\Http\Controllers\HomeController::class,'logout']);

Route::prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class,'index']);
    Route::get('users', [\App\Http\Controllers\AdminController::class,'users']);
    Route::get('add-new-request', [\App\Http\Controllers\AdminController::class,'addNewRequest']);
    Route::get('add-new-user', [\App\Http\Controllers\AdminController::class,'addNewUser']);
    Route::get('add-new-location', [\App\Http\Controllers\AdminController::class,'addNewLocation']);

    Route::post('createLocation', [\App\Http\Controllers\AdminController::class,'createLocation'])->name('createLocation');
    Route::post('createUser',[\App\Http\Controllers\AdminController::class,'createUser'])->name('createUser');
    Route::post('createTicket',[\App\Http\Controllers\AdminController::class,'createTicket'])->name('createTicket');

});

Route::prefix('user')->group(function () {

});

