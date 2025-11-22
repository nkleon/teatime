<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('farms', App\Http\Controllers\FarmController::class);
Route::resource('users', App\Http\Controllers\UserController::class);
Route::resource('collections', App\Http\Controllers\CollectionController::class);
Route::resource('roles', App\Http\Controllers\RoleController::class);
Route::resource('payment_methods', App\Http\Controllers\PaymentMethodController::class);
