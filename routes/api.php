<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\StreetController;
use App\Http\Controllers\PostCodeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/addresses', [AddressController::class, 'index']);
Route::get('/cities', [CityController::class, 'index']);
Route::get('/areas', [AreaController::class, 'index']);
Route::get('/streets', [StreetController::class, 'index']);
Route::get('/postcodes', [PostCodeController::class, 'index']);

