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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('vehicleStatus', 'App\Http\Controllers\API\VehicleStatusController@index');
Route::post('vehicleStatus', 'App\Http\Controllers\API\VehicleStatusController@store');

Route::get('location', 'App\Http\Controllers\API\LocationController@index');
Route::post('location', 'App\Http\Controllers\API\LocationController@store');
