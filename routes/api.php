<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\EditionsController;
use App\Http\Controllers\BookEditionsController;
use App\Http\Controllers\LibrairyController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ReadingStatusController;
use App\Http\Controllers\UserApiAuthetification;

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

/* Route d'authentification */
Route::post('register', [UserApiAuthetification::class, 'store']);
Route::post('login', [UserApiAuthetification::class, 'login']);

/* Route sécurisé par le login de l'application */
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('users', [UserApiAuthetification::class, 'show']);
    Route::get('logout', [UserApiAuthetification::class, 'logout']);

    /* Controle des livres */
    Route::resource('books', BooksController::class);

    /* Controle des editions */
    Route::get('editions/all', [EditionsController::class, 'index']);
    Route::get('editions/{id}', [EditionsController::class, 'find']);
    Route::post('editions/add', [EditionsController::class, 'store']);

    /* Controle par edition de livre */
    Route::resource('book_editions', BookEditionsController::class);
    Route::get('book/editions/{id}', [BookEditionsController::class, 'findAllBookEdition']);

    /* route de recherche */
    Route::get('book/author/{id}', [BooksController::class, 'searchByauthor']);
    Route::get('book/category/{id}', [BooksController::class, 'searchByCategory']);
    Route::get('book/editor/{id}', [BooksController::class, 'searchByEditor']);

    /* Controle des bibliothéque */
    Route::resource('librairy', LibrairyController::class);

    /* Controle de la wishlist */
    Route::resource('wishlist', WishlistController::class);

    /* Controle des commentaires */
    Route::resource('comments', CommentsController::class);

    /* Controle des status de lecture */
    Route::resource('readingstatus', ReadingStatusController::class);
});


