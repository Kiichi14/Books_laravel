<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\EditionsController;
use App\Http\Controllers\BookEditionsController;

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

/* Controle des livres */
Route::resource('books', BooksController::class);

/* Controle des editions */
Route::get('editions/all', [EditionsController::class, 'index']);
Route::get('editions/{id}', [EditionsController::class, 'find']);
Route::post('editions/add', [EditionsController::class, 'store']);

/* Controle par edition de livre */
Route::resource('book_editions', BookEditionsController::class);
Route::get('book/editions/{id}', [BookEditionsController::class, 'findAllBookEdition']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

