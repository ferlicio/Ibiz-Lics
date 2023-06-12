<?php

use App\Http\Controllers\Api\DeletedLicController;
use App\Http\Controllers\Api\LicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {
    Route::apiResource('lics', LicController::class);
    Route::apiResource('deletedLics', DeletedLicController::class);
});

Route::Put('lics/{lic}/nuFase', LicController::class . '@updateNuFase');
Route::Put('lics/{lic}/licitador', LicController::class . '@updateLicitador');