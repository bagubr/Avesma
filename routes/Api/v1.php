<?php

use App\Http\Controllers\Api\AuthController;
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

Route::get('login', function() {
    return "Login";
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login/phone', [AuthController::class, 'loginPhone']);
Route::post('login/email', [AuthController::class, 'loginEmail']);
Route::post('imei', [AuthController::class, 'imeiCheck']);