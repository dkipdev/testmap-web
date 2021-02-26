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
    return view('peta');
});

// ROUTE MARKERS
Route::get('/markers', [MarkersController::class, 'index']);
Route::get('/markers/create', [MarkersController::class, 'create']);
Route::post('/markers', [MarkersController::class, 'store'])->name('markers.store');
Route::delete('/markers/{id}', [MarkersController::class, 'destroy'])->name('markers.delete');
Route::post('/markers-update', [MarkersController::class, 'update'])->name('markers.update');
Route::get('/markers/{id}/edit', [MarkersController::class, 'edit']);

// ROUTE KATEGORI MARKER
Route::get('/kategori', [MarkerCategoriesController::class, 'index']);
Route::get('/kategori/create', [MarkerCategoriesController::class, 'create']);
Route::get('/kategori/{id}/edit', [MarkerCategoriesController::class, 'edit']);
Route::delete('/kategori/{id}', [MarkerCategoriesController::class, 'destroy'])->name('deletekategori');
Route::post('/kategori', [MarkerCategoriesController::class, 'store']);
Route::post('/kategori-update', [MarkerCategoriesController::class, 'update'])->name('updatekategori');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

//Route FrontEnd
