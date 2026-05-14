<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NfcController;
use App\Http\Middleware\RoleMiddleware;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware(['auth:sanctum', RoleMiddleware::class . ':doctor'])->group(function () {
    Route::post('/validar-nfc', [NfcController::class, 'verificacion']);});


// El ESP32 golpea esta puerta para decir quién llegó
Route::post('/validar-nfc', [NfcController::class, 'verificacion']);

//El Dashboard del Doctor consulta esta puerta cada 2 segundos
Route::get('/check-nfc-status', [NfcController::class, 'checkStatus']);