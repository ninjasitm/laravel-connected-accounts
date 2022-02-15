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

$routeBase = config("nitm-connected-accounts.routes.base", "connected-accounts");
$routeName = config("nitm-connected-accounts.routes.name", "connected-accounts");

Route::middleware(config("nitm-connected-accounts.routes.middleware", ['api']))->group(function () {
    Route::get("{$routeBase}/{provider}/start/{type}", "API\Auth\SocialAuthAPIController@show")->name($routeName . ".start");
    Route::get("{$routeBase}/{provider}/mobile", "API\Auth\SocialAuthAPIController@storeForMobile")->name($routeName . ".mobile");
    Route::get("{$routeBase}/{provider}/web", "API\Auth\SocialAuthAPIController@storeForWeb")->name($routeName . ".web");
});