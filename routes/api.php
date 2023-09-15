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
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthorStatsController;

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

/* Route de test lecture api */
Route::get('test', [TestController::class, 'test']);

/* Route d'authentification */
Route::post('register', [UserApiAuthetification::class, 'store']);
Route::post('login', [UserApiAuthetification::class, 'login']);

/* Route sécurisé par le login de l'application */
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('logout', [UserApiAuthetification::class, 'logout']);
    Route::get('users', [UserApiAuthetification::class, 'show']);

    /* Controle des livres */
    Route::resource('books', BooksController::class);

    /* Controle des editions */
    Route::resource('editions', EditionsController::class)->middleware('checkrole:admin');

    /* Controle par edition de livre */
    Route::resource('book_editions', BookEditionsController::class);
    Route::get('book/editions/{id}', [BookEditionsController::class, 'findAllBookEdition']);

    /* route de recherche */
    Route::get('book/author/{id}', [BooksController::class, 'searchByauthor']);
    Route::get('book/category/{id}', [BooksController::class, 'searchByCategory']);
    Route::get('book/editor/{id}', [BooksController::class, 'searchByEditor']);

    /* Controle des bibliothéque */
    Route::get('librairy/{id}', [LibrairyController::class, 'show']);
    Route::post('librairy/add', [LibrairyController::class, 'store']);
    Route::delete('librairy/delete/{idUser}/{idBook}', [LibrairyController::class, 'destroy']);

    /* Controle de la wishlist */
    //Route::resource('wishlist', WishlistController::class);
    Route::get('wishlist/{id}', [WishlistController::class, 'show']);
    Route::post('wishlist/add', [WishlistController::class, 'store']);
    Route::delete('wishlist/delete/{idUser}/{idBook}', [WishlistController::class, 'destroy']);

    /* Controle des commentaires */
    Route::resource('comments', CommentsController::class);

    /* Controle des status de lecture */
    Route::resource('readingstatus', ReadingStatusController::class);

    /* Route de stats */
    Route::resource('author', AuthorStatsController::class);
    Route::get('author/rate/{id}', [AuthorStatsController::class, 'averageAuthor']);

    /* Test route nombre de livre en cours de lecture chez l'auteur */
    Route::get('author/reading/inprogress/{idAuthor}', [AuthorStatsController::class, 'bookInRead']);
});


