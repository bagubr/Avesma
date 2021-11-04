<?php

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
});
