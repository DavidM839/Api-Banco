<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\HistorialTransaccionesController;

Route::apiResource('clientes', ClienteController::class);
Route::apiResource('cuentas', CuentaController::class);
Route::apiResource('transacciones', TransaccionController::class);
