<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\presenca;
use App\Http\Controllers\TurmaController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');





Route::apiResource('/presentes', presenca::class);
Route::apiResource('/users', UserController::class );
Route::apiResource('/turmas', TurmaController::class );
