<?php

use App\Http\Controllers\MarkerCategoriesController;
use App\Http\Controllers\MarkersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin.dashboard');
});
Route::get('/markers', [MarkersController::class, 'index']);
Route::get('/kategori', [MarkerCategoriesController::class, 'index']);
Route::get('/kategori/create', [MarkerCategoriesController::class, 'create']);
Route::get('/kategori/{id}', [MarkerCategoriesController::class, 'show']);
Route::delete('/kategori/{id}', [MarkerCategoriesController::class, 'destroy']);
Route::post('/kategori', [MarkerCategoriesController::class, 'store']);