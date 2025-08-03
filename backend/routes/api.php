<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AvailableCarsController;

Route::middleware('auth:sanctum')->get(
'available-cars',
[AvailableCarsController::class, 'index']
);
