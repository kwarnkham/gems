<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:admin'])
    ->controller(ItemController::class)
    ->prefix('items')
    ->group(function () {
        Route::post('', 'store');
    });
