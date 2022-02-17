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


$routeBase = config("social-auth.routes.prefix", "connected-accounts");
$routeName = config("social-auth.routes.name", "connected-accounts");
Route::middleware(config("social-auth.routes.middleware", ['api']))
    ->prefix($routeBase)
    ->as($routeName . '.')
    ->namespace(config("nitm-notifications.routes.namespace", 'Nitm\ConnectedAccounts\Http\Controllers'))
    ->group(function () {
        Route::get("{provider}/start/{type}", "Auth\SocialAuthAPIController@show")->name("start");
        Route::get("{provider}/mobile", "Auth\SocialAuthAPIController@storeForMobile")->name("mobile");
        Route::get("{provider}/web", "Auth\SocialAuthAPIController@storeForWeb")->name("web");

        Route::apiResource("", "Auth\SocialAccountsAPIController")->parameters([
            "" => "account"
        ]);
    });