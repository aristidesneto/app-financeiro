<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EntryController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CreditCardController;
use App\Http\Controllers\Api\BankAccountController;

// Route::resource('category', CategoryController::class);
Route::middleware(['auth:api'])->group(function () {
    Route::resource('entry', EntryController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('bank-account', BankAccountController::class);
    Route::resource('credit-card', CreditCardController::class);
});
