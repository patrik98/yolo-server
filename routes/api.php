<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('v1/login', [\App\Http\Controllers\AuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->delete('v1/logout', [\App\Http\Controllers\AuthenticationController::class, 'logout']);

Route::middleware('auth:sanctum')->get('v1/projects', [\App\Http\Controllers\ProjectController::class, 'index']);

