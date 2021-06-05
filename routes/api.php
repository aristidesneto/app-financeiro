<?php

use App\Http\Controllers\Api\BankAccountController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CreditCardController;
use App\Http\Controllers\Api\EntryController;
use App\Http\Controllers\Auth\ApiAuthController;
use Illuminate\Support\Facades\Route;

// public routes
Route::post('login', [ApiAuthController::class, 'login'])->name('login.api');
Route::post('register', [ApiAuthController::class, 'register'])->name('register.api');

// Route::resource('category', CategoryController::class);
Route::middleware(['auth.api'])->group(function () {
    Route::get('authenticated/me', [ApiAuthController::class, 'me'])->name('me');
    Route::post('logout', [ApiAuthController::class, 'logout'])->name('logout.api');

    Route::resource('entry', EntryController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('bank-account', BankAccountController::class);
    Route::resource('credit-card', CreditCardController::class);
});
