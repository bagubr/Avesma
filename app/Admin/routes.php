<?php

use App\Admin\Controllers\PondDetailController;
use Encore\Admin\Facades\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('users', UserController::class);
    $router->resource('pokdakans', PokdakanController::class);
    $router->resource('regions', RegionController::class);
    $router->resource('user-informations', UserInformationController::class);
    $router->resource('fish-species', FishSpeciesController::class);
    $router->resource('fish-categories', FishCategoryController::class);
    $router->resource('sliders', SliderController::class);
    $router->resource('articles', ArticleController::class);
    $router->resource('article-categories', ArticleCategoryController::class);
    $router->resource('article-procedures', ArticleProcedureController::class);
    $router->resource('article-recipes', ArticleRecipeController::class);
    $router->resource('procedures', ProcedureController::class);
    $router->resource('form-procedures', FormProcedureController::class);
    $router->resource('form-procedure-formulas', FormProcedureFormulaController::class);
    $router->get('form-procedure-details/by_pond_detail_id', 'FormProcedureDetailController@byPondDetailId');
    $router->resource('form-procedure-details', FormProcedureDetailController::class);
    $router->resource('form-procedure-detail-formulas', FormProcedureDetailFormulaController::class);
    $router->get('form-procedure-detail-formula/get_by_form_procedure_detail', 'FormProcedureDetailFormulaController@getByFormProcedureDetail');
    $router->resource('form-procedure-detail-inputs', FormProcedureDetailInputController::class);
    $router->resource('form-procedure-input-users', FormProcedureInputUserController::class);
    $router->resource('ponds', PondController::class);
    $router->get('pond-details/by_user_id', 'PondDetailController@byUserId');
    $router->resource('pond-details', PondDetailController::class);
    $router->resource('pond-detail-products', PondDetailProductController::class);
    $router->get('pond-detail-product/get_by_pond_detail', 'PondDetailProductController@getByPondDetail');
    $router->resource('incomes', IncomeController::class);
    $router->resource('income-details', IncomeDetailController::class);
    $router->resource('outcomes', OutcomeController::class);
    $router->resource('outcome-categories', OutcomeCategoryController::class);
    $router->resource('outcome-settings', OutcomeSettingController::class);
    $router->resource('settings', SettingController::class);
    $router->resource('testimonials', TestimonialController::class);
    $router->resource('abouts', AboutController::class);
    $router->resource('social-medias', SocialMediaController::class);
    $router->resource('privacy-policies', PrivacyController::class);
    $router->resource('benefits', BenefitController::class);
    $router->resource('term-and-conditions', TermAndConditionController::class);
    $router->resource('fish-prices', FishPriceController::class);
    $router->resource('disclaimers', DisclaimerController::class);
    $router->resource('outcome-details', OutcomeDetailController::class);
    $router->resource('contacts', ContactController::class);
    $router->resource('faqs', FaqController::class);
    $router->resource('slider-markets', SliderMarketController::class);
});
