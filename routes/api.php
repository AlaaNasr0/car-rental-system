<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

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

Route::get('/auth/register', [UserController::class, 'showRegisterForm']);
Route::post('/auth/register', [UserController::class, 'createUser']);
Route::get('/auth/login', [UserController::class, 'showLoginForm']);
Route::post('/auth/login', [UserController::class, 'loginUser']);
