<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ArticleCategoryController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\PondController;
use App\Http\Controllers\Api\ProcedureController;
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

Route::get('login', function() {
    return "Login";
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login/phone', [AuthController::class, 'loginPhone']);
Route::post('login/email', [AuthController::class, 'loginEmail']);
Route::post('imei', [AuthController::class, 'imeiCheck']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('article_categories', [ArticleCategoryController::class, 'index']);

    Route::get('procedures', [ProcedureController::class, 'index']);

    Route::get('home', [HomeController::class, 'index']);

    Route::get('ponds', [PondController::class, 'index']);
    Route::post('ponds/store', [PondController::class, 'store']);

    Route::get('profile', [UserController::class, 'index']);
    Route::post('profile', [UserController::class, 'update']);
});