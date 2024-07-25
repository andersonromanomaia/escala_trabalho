<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/listarfiliais', [\App\Http\Controllers\ColaboradorController::class,'listarFiliais']);
Route::get('/listarmes', [\App\Http\Controllers\ColaboradorController::class,'listarMeses']);
Route::post('/import', [\App\Http\Controllers\ColaboradorController::class,'import']);
Route::get('/reportfolgas', [\App\Http\Controllers\ColaboradorController::class,'retornoFolgaMes']);