<?php

use App\Http\Controllers\Apis\AddressController;
use App\Http\Controllers\Apis\MenuController;
use App\Http\Controllers\Apis\CityController;
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

Route::get('menus', [MenuController::class, 'index']);

Route::resource('address', AddressController::class);
Route::resource('ufs', UfController::class);
Route::resource('cities', CityController::class);
