<?php

use App\Http\Controllers\Apis\AddressController;
use App\Http\Controllers\Apis\CardController;
use App\Http\Controllers\Apis\LocalityController;
use App\Http\Controllers\Apis\MenuController;
use App\Http\Controllers\Apis\CityController;
use App\Http\Controllers\Apis\ServiceGroupController;
use App\Http\Controllers\Apis\UfController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Menu
Route::get('menus', [MenuController::class, 'index']);

//Helper routes
Route::get('service-groups/{id}/localities', [ServiceGroupController::class, 'localities']);
Route::get('localities/{id}/cards', [LocalityController::class, 'cards']);
Route::post('cards/to-print', [CardController::class, 'toPrint']);

//Resources
Route::resource('addresses', AddressController::class);
Route::resource('cards', CardController::class);
Route::resource('cities', CityController::class);
Route::resource('localities', LocalityController::class);
Route::resource('service-groups', ServiceGroupController::class);
Route::resource('ufs', UfController::class);



