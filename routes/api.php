<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::controller(ItemController::class)
    ->prefix('items')
    ->group(function () {
        Route::middleware(['role:admin', 'auth:sanctum'])->group(function () {
            Route::post('', 'store');
            Route::post('{item}', 'update');
        });

        Route::get('', 'index');
        Route::get('{item}', 'find');
    });
