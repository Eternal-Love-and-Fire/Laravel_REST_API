<?php

use App\Http\Controllers\TokenGenerationController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ValidateToken;
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

Route::get('v1/token', TokenGenerationController::class);

Route::get('/users', [UserController::class, 'index']);

Route::post('/users', [UserController::class, 'store'])->middleware(ValidateToken::class);


