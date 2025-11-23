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
Route::resource('farms', App\Http\Controllers\FarmController::class);
Route::resource('users', App\Http\Controllers\UserController::class);
Route::resource('collections', App\Http\Controllers\CollectionController::class);
Route::resource('roles', App\Http\Controllers\RoleController::class);
Route::resource('payment_methods', App\Http\Controllers\PaymentMethodController::class);

Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('farms', FarmController::class);
Route::resource('collections', CollectionController::class);
Route::resource('payments', PaymentController::class);
Route::resource('payment-methods', PaymentMethodController::class);

// Listing routes for all main models
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/farms', [FarmController::class, 'index'])->name('farms.index');
Route::get('/collections', [CollectionController::class, 'index'])->name('collections.index');
Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
Route::get('/payment-methods', [PaymentMethodController::class, 'index'])->name('payment_methods.index');
