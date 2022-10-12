<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('index');
Route::delete('/', [\App\Http\Controllers\IndexController::class, 'delete'])->name('delete');
