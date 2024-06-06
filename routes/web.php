<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AddressController;

use App\Http\Controllers\CityController;
use App\Http\Controllers\PostCodeController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\StreetController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostCodeAreaController;


use App\Http\Controllers\AdressesOpinionController;
use App\Http\Controllers\HomeClientController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();

Route::get('/h', [HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('opinions', AdressesOpinionController::class);
Route::put('opinions/{opinion}/deactivate', [AdressesOpinionController::class, 'deactivate'])->name('opinions.deactivate');
Route::put('opinions/{opinion}/activate', [AdressesOpinionController::class, 'activate'])->name('opinions.activate');
Route::get('adressClientConfirme', [AdressesOpinionController::class, 'adressClientConfirme'])->name('opinions.adressClientConfirme');
Route::put('opinions/{opinion}/update-review-status', [AdressesOpinionController::class, 'updateReviewStatus'])
    ->name('opinions.updateReviewStatus');


Route::get('/', [HomeClientController::class, 'index'])->name('homeClient.index');

Route::group(['middleware' => ['auth']], function() {

Route::resource('cities', CityController::class);
Route::resource('postCodes', PostCodeController::class);
Route::resource('areas', AreaController::class);
Route::resource('streets', StreetController::class);
Route::resource('houses', HouseController::class);

Route::get('/get-areas/{cityId}', [HouseController::class, 'getAreas']);
Route::get('/get-streets/{areaId}', [HouseController::class, 'getStreets']);
Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index');
Route::resource('postCodeAreas', PostCodeAreaController::class);


Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
});

