<?php

use App\Http\Controllers\AppSettingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MeetController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\PreOrderController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\SpecificationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(ItemController::class)
    ->prefix('items')
    ->group(function () {
        Route::middleware(['role:admin', 'auth:sanctum'])->group(function () {
            Route::post('', 'store');
            Route::put('{item}', 'update');
            Route::post('{item}/pictures', 'addPictures');
            Route::post('{item}/categories/sync', 'syncCategories');
        });

        Route::get('', 'index');
        Route::get('{item}', 'find');
        Route::post('{item}/toggle-status', 'toggleStatus');
    });

Route::controller(PictureController::class)
    ->prefix('pictures')
    ->group(function () {
        Route::middleware(['role:admin', 'auth:sanctum'])->group(function () {
            Route::delete('{picture}', 'destroy');
            Route::put('{picture}', 'update');
        });
    });


Route::controller(PriceController::class)
    ->prefix('prices')
    ->group(function () {
        Route::middleware(['role:admin', 'auth:sanctum'])->group(function () {
            Route::post('', 'store');
            Route::put('{price}', 'update');
        });
        Route::get('', 'index');
    });

Route::controller(SpecificationController::class)
    ->prefix('specifications')
    ->group(function () {
        Route::middleware(['role:admin', 'auth:sanctum'])->group(function () {
            Route::post('', 'store');
            Route::put('{specification}', 'update');
            Route::get('{specification}', 'find');
        });
    });

Route::controller(PreOrderController::class)
    ->prefix('pre-orders')
    ->group(function () {
        Route::middleware(['role:admin', 'auth:sanctum'])->group(function () {
            Route::post('', 'store');
            Route::put('{preOrder}', 'update');
            Route::post('{preOrder}/status', 'status');
            Route::get('', 'index');
            Route::get('{preOrder}', 'find');
        });
    });

Route::controller(AppSettingController::class)
    ->prefix('app-settings')
    ->group(function () {
        Route::middleware(['role:admin', 'auth:sanctum'])->group(function () {
            Route::put('{appSetting}', 'update');
        });
        Route::get('{appSetting}', 'find');
    });

Route::controller(CategoryController::class)
    ->prefix('categories')
    ->group(function () {
        Route::middleware(['role:admin', 'auth:sanctum'])->group(function () {
            Route::post('', 'store');
            Route::get('', 'index');
        });
    });

Route::controller(UserController::class)
    ->prefix('users')
    ->group(function () {
        Route::middleware(['auth:sanctum'])->group(function () {
            Route::get('me', 'me');
        });
    });

Route::controller(ContactController::class)
    ->prefix('contacts')
    ->group(function () {
        Route::post('', 'store');
        Route::middleware(['auth:sanctum'])->group(function () {
            Route::get('', 'index');
            Route::get('{contact}', 'find');
        });
    });

Route::controller(MeetController::class)
    ->prefix('meets')
    ->group(function () {
        Route::middleware(['auth:sanctum'])->group(function () {
            Route::post('', 'store');
        });
    });


Route::controller(AuthController::class)
    ->group(function () {
        Route::middleware(['auth:sanctum'])->group(function () {
            Route::post('logout', 'logout');
        });
        Route::post('login', 'login');
    });
