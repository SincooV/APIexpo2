<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\presenca;
use App\Http\Controllers\TurmaController;





Route::apiResource('/presentes', presenca::class);
Route::apiResource('/users', UserController::class );
Route::apiResource('/turmas', TurmaController::class );
Route::patch('/user/{id}', [UserController::class, 'patch' ]);
Route::put('/users/{id}', [UserController::class, 'update' ]);  
Route::post('/presentes/search/{turmaName}', [presenca::class, 'storePresence']);
Route::post('/user', [UserController::class, 'store']);
Route::get('/turmas/search/{id}', [TurmaController::class, 'searchByTurma' ]);
Route::get('/turmas/by-aluno/{id}', [TurmaController::class, 'searchByAluno']);
Route::middleware('throttle:api')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
});
