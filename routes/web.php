<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('about', function () {
    return view('about');
})->name('about');

Route::middleware(['guest'])->group(function(){
    Route::get('register', [UserController::class, 'register'])->name('register');
    Route::post('onboard', [UserController::class, 'onboard'])->name('onboard');
    Route::get('login', [UserController::class, 'login'])->name('login');
    Route::post('authenticate', [UserController::class, 'authenticate'])->name('authenticate');
});

Route::middleware(['auth'])->group(function(){
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('farms', FarmController::class);
    Route::resource('collections', CollectionController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('payment-methods', PaymentMethodController::class);
});