<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntryController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('expense', EntryController::class);

    Route::get('entries', [EntryController::class, 'entries'])->name('entries.index');
});


require __DIR__.'/auth.php';
