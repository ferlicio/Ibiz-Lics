<?php

use App\Http\Controllers\FrontEnd\InertiaRoutesController;
use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', InertiaRoutesController::class . '@homepage');
Route::get('/licitacoes', InertiaRoutesController::class . '@licitacoes');
Route::get('/licitacoes/{id}', InertiaRoutesController::class . '@licitacao');
Route::get('/licitacoes/nova', InertiaRoutesController::class . '@licitacao');
