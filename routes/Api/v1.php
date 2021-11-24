<?php

use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ArticleCategoryController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\ArticleProcedureController;
use App\Http\Controllers\Api\ArticleRecipeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BuyerController;
use App\Http\Controllers\Api\DisclaimerController;
use App\Http\Controllers\Api\FishCategoryController;
use App\Http\Controllers\Api\FishPriceController;
use App\Http\Controllers\Api\FishSpeciesController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\IncomeController;
use App\Http\Controllers\Api\OutcomeCategoryController;
use App\Http\Controllers\Api\OutcomeController;
use App\Http\Controllers\Api\OutcomeSettingController;
use App\Http\Controllers\Api\PokdakanController;
use App\Http\Controllers\Api\PondController;
use App\Http\Controllers\Api\PondDetailProductController;
use App\Http\Controllers\Api\PrivacyPolicyController;
use App\Http\Controllers\Api\ProcedureController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\TermAndConditionController;
use App\Models\Buyer;
use App\Models\TermAndCondition;
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

Route::get('login', function () {
    return "Login";
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login/phone', [AuthController::class, 'loginPhone']);
Route::post('login/email', [AuthController::class, 'loginEmail']);
Route::post('imei', [AuthController::class, 'imeiCheck']);

Route::get('pokdakans', [PokdakanController::class, 'index']);
Route::get('regions', [RegionController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('article', [ArticleController::class, 'index']);
    Route::get('article/{id}', [ArticleController::class, 'show']);

    Route::get('article_categories', [ArticleCategoryController::class, 'index']);

    Route::get('article_procedures', [ArticleProcedureController::class, 'index']);
    Route::get('article_procedures/{id}', [ArticleProcedureController::class, 'show']);

    Route::get('article_recipes', [ArticleRecipeController::class, 'index']);
    Route::get('article_recipes/{id}', [ArticleRecipeController::class, 'show']);


    Route::get('fish_prices', [FishPriceController::class, 'index']);
    Route::get('fish_prices/{fish_price}', [FishPriceController::class, 'show']);

    Route::get('procedures', [ProcedureController::class, 'index']);
    Route::get('procedures/list', [ProcedureController::class, 'getProcedureList']);
    Route::get('procedures/list/{id}', [ProcedureController::class, 'getProcedureShow']);
    Route::post('procedures', [ProcedureController::class, 'store']);
    Route::post('procedures/edit/{form_procedure_input_user}', [ProcedureController::class, 'update']);
    Route::get('procedures/form_procedure/{id}', [ProcedureController::class, 'getFormProcedure']);

    Route::get('home', [HomeController::class, 'index']);

    Route::get('ponds', [PondController::class, 'index']);
    Route::post('ponds/store', [PondController::class, 'store']);
    Route::get('ponds/{id}', [PondController::class, 'show'])->where('id', '[0-9]+');
    Route::get('ponds/status', [PondController::class, 'statuses']);
    Route::post('ponds/update/{id}', [PondController::class, 'update']);
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
    Route::get('incomes/{id}', [IncomeController::class, 'show']);
    Route::post('incomes/{income}', [IncomeController::class, 'update']);

    Route::get('outcomes/categories', [OutcomeCategoryController::class, 'index']);
    Route::get('outcomes/settings', [OutcomeSettingController::class, 'index']);
    Route::get('outcomes', [OutcomeController::class, 'index']);
    Route::post('outcomes', [OutcomeController::class, 'store']);
    Route::get('outcomes/{outcome}', [OutcomeController::class, 'show']);

    Route::get('buyers', [BuyerController::class, 'index']);
    Route::get('buyers/{id}', [BuyerController::class, 'show']);
    Route::post('buyers/update/{id}', [BuyerController::class, 'update']);

    Route::get('about', [AboutController::class, 'index']);

    Route::get('privacy_policy', [PrivacyPolicyController::class, 'index']);

    Route::get('term_and_condition', [TermAndConditionController::class, 'index']);
});
