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

// Listing routes for all main models
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/farms', [FarmController::class, 'index'])->name('farms.index');
Route::get('/collections', [CollectionController::class, 'index'])->name('collections.index');
Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
Route::get('/payment-methods', [PaymentMethodController::class, 'index'])->name('payment_methods.index');
