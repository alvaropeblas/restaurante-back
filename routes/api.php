<?php

use App\Http\Controllers\ApiFechaController;
use App\Http\Controllers\ApiReservaController;
use App\Http\Controllers\ApiReservaOutController;
use App\Http\Controllers\ApiTarjetaController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/users', [AuthController::class, 'users']);
Route::post('/userRegister', [AuthController::class, 'createUser']);
Route::post('/login', [AuthController::class, 'loginUser']);
Route::post('/crearReservaOut', [ApiReservaOutController::class, 'crearReserva']);
Route::get('/fechas', [ApiFechaController::class, 'obtenerFechas']);



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/misReservas', [ApiReservaController::class, 'obtenerReservas']);
    Route::post('/crearReserva', [ApiReservaController::class, 'crearReserva']);
    Route::delete('/eliminarReserva/{id}', [ApiReservaController::class, 'eliminarReserva']);
    Route::get('/misTarjetas', [ApiTarjetaController::class, 'obtenerTarjetas']);
    Route::post('/crearTarjeta', [ApiTarjetaController::class, 'crearTarjeta']);
    Route::delete('/eliminarTarjeta/{id}', [ApiTarjetaController::class, 'eliminarTarjeta']);
    Route::get('/getUserById', [AuthController::class, 'getUserById']);
});
