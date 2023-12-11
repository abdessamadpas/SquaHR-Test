<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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



Route::post('/register', [UserController::class, 'registration']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/login', [UserController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('tasks', [TaskController::class, 'store']);
    Route::get('tasks', [TaskController::class, 'index']);
    Route::put('tasks/{id}', [TaskController::class, 'update']);
    Route::delete('tasks/{id}', [TaskController::class, 'destroy']);
});