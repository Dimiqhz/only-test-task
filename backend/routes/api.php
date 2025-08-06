<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AvailableCarsController;
use App\Http\Controllers\Api\ComfortCategoryController;
use App\Http\Controllers\Api\AuthController;

Route::get('/comfort-categories',    [ComfortCategoryController::class,    'index']);
Route::post('/login',    [AuthController::class, 'login']);
Route::post('/logout',   [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user',      [AuthController::class, 'user'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/available-cars',        [AvailableCarsController::class,      'index']);
});
