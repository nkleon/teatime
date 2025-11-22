<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('farms', App\Http\Controllers\FarmController::class);
Route::resource('users', App\Http\Controllers\UserController::class);
