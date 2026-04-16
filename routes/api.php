<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\TrajetController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::apiResource('departements', DepartementController::class);
    Route::apiResource('employes', EmployeController::class);
    Route::apiResource('conges', CongeController::class);
    Route::apiResource('vehicules', VehiculeController::class);
    Route::apiResource('trajets', TrajetController::class);
});