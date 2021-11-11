<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ArticleCategoryController;
use App\Http\Controllers\Api\ArticleProcedureController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BuyerController;
use App\Http\Controllers\Api\FishCategoryController;
use App\Http\Controllers\Api\FishSpeciesController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\IncomeController;
use App\Http\Controllers\Api\OutcomeCategoryController;
use App\Http\Controllers\Api\OutcomeController;
use App\Http\Controllers\Api\OutcomeSettingController;
use App\Http\Controllers\Api\PokdakanController;
use App\Http\Controllers\Api\PondController;
use App\Http\Controllers\Api\PondDetailProductController;
use App\Http\Controllers\Api\ProcedureController;
use App\Http\Controllers\Api\RegionController;
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

Route::get('pokdakans', [PokdakanController::class, 'index']);
Route::get('regions', [RegionController::class, 'index']);

Route::middleware('auth:sanctum')->group(function() {

    Route::get('article_categories', [ArticleCategoryController::class, 'index']);

    Route::get('article_procedures', [ArticleProcedureController::class, 'index']);
    Route::get('article_procedures/{id}', [ArticleProcedureController::class, 'show']);

    Route::get('procedures', [ProcedureController::class, 'index']);

    Route::get('home', [HomeController::class, 'index']);

    Route::get('ponds', [PondController::class, 'index']);
    Route::post('ponds/store', [PondController::class, 'store']);
    Route::get('ponds/{id}', [PondController::class, 'show'])->where('id', '[0-9]+');
    Route::get('ponds/products', [PondDetailProductController::class, 'index']);
    Route::post('ponds/products', [PondDetailProductController::class, 'store']);

    Route::get('profile', [UserController::class, 'index']);
    Route::post('profile', [UserController::class, 'update']);
    Route::post('profile/avatar', [UserController::class, 'updateAvatar']);
    Route::post('profile/verification', [UserController::class, 'uploadInformation']);

    Route::get('fish_specieses', [FishSpeciesController::class, 'index']);

    Route::get('fish_categories', [FishCategoryController::class, 'index']);

    Route::get('incomes', [IncomeController::class, 'index']);
    Route::post('incomes', [IncomeController::class, 'store']);

    Route::get('outcomes/categories', [OutcomeCategoryController::class, 'index']);
    Route::get('outcomes/settings', [OutcomeSettingController::class, 'index']);
    Route::get('outcomes', [OutcomeController::class, 'index']);
    Route::post('outcomes', [OutcomeController::class, 'store']);
    Route::get('outcomes/show', [OutcomeController::class, 'show']);

    Route::get('buyers', [BuyerController::class, 'index']);
});