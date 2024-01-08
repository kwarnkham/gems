<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\PriceController;
use Illuminate\Support\Facades\Route;

Route::controller(ItemController::class)
    ->prefix('items')
    ->group(function () {
        Route::middleware(['role:admin', 'auth:sanctum'])->group(function () {
            Route::post('', 'store');
            Route::put('{item}', 'update');
            Route::post('{item}/pictures', 'addPictures');
        });

        Route::get('', 'index');
        Route::get('{item}', 'find');
    });

Route::controller(PictureController::class)
    ->prefix('pictures')
    ->group(function () {
        Route::middleware(['role:admin', 'auth:sanctum'])->group(function () {
            Route::delete('{picture}', 'destroy');
        });
    });


Route::controller(PriceController::class)
    ->prefix('prices')
    ->group(function () {
        Route::middleware(['role:admin', 'auth:sanctum'])->group(function () {
            Route::post('', 'store');
        });
    });
