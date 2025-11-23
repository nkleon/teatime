<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethodController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('farms', FarmController::class);
Route::resource('collections', CollectionController::class);
Route::resource('payments', PaymentController::class);
Route::resource('payment-methods', PaymentMethodController::class);