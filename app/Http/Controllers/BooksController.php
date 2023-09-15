<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Http\Requests\CreateBooksRequest;

class BooksController extends Controller
{

    /* Mise en place du middleware pour bloquer les méthodes store update, destroy */
    public function __construct() {
        $this->middleware('checkrole:admin')->except(['index', 'show', 'searchByauthor', 'searchByEditor']);
    }

    /* Capture de tous les livres avec leurs relations et classement par note */
    public function index() {

        $books = Books::with('category', 'editor', 'author', 'rate')->get();

        /* Calcul de la moyenne */
        foreach($books as $book) {
            $comments = $book->rate;
            $rate = $comments->pluck('rate')->avg();
            $book['note'] = $rate;
            unset($book['rate']);
        }

        $newArray = json_decode($books);

        $laravelArray = collect($newArray);

        $sorted = $laravelArray->sortByDesc('note');

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Touts les livres',
            'livres' => $sorted
        ]);

    }

    /* Capture d'un livre par son id avec ses relations */
    public function show($id) {

        $book = Books::with('category', 'editor', 'author', 'rate')->where('id', $id)->get();

        $comments = $book->first()->rate;

        $avg = $comments->pluck('rate')->avg();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'livres uniques',
            'livre' => $book,
            'average' => $avg
        ]);
    }

    /* Ajout d'un livre */
    public function store(CreateBooksRequest $request) {
        $book = new Books();

        $input = $request->all();

        $book->title = $input['title'];
        $book->resume = $input['resume'];
        $book->category_id = $input['category_id'];
        $book->author_id = $input['author_id'];
        $book->editor_id = $input['editor_id'];

        $book->save();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Votre livre a bien été ajouté',
            'livre' => $book
        ]);

    }

    /* Mise a jour d'un livre */
    public function update(CreateBooksRequest $request, $id) {

        $input = $request->all();

        $book = Books::where('id', $id)->update([
            'title' => $input['title'],
            'resume' => $input['resume'],
            'category_id' => $input['category_id'],
            'author_id' => $input['author_id'],
            'editor_id' => $input['editor_id']
        ]);

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Votre livre a bien été mis a jour',
            'book' => $book
        ]);

    }

    /* Suppression d'un livre */
    public function destroy($id) {

        $book = Books::where('id', $id)->delete();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Votre livre a bien été supprimer',
            'book' => $book
        ]);

    }

    /* Méthode de recherche */
    // recherche par auteur
    public function searchByauthor($idAuthor) {

        $books = Books::with('category', 'editor', 'author', 'editions.editions')->where('author_id', $idAuthor)->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Touts les livres de l\'auteur',
            'livre' => $books
        ]);

    }

    // recherche par catégorie
    public function searchByCategory($idCategory) {

        $books = Books::with('category', 'editor', 'author', 'editions.editions')->where('category_id', $idCategory)->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Touts les livres de cette catégorie',
            'livre' => $books
        ]);

    }

    // recherche par editeur
    public function searchByEditor($idEditor) {

        $books = Books::with('category', 'editor', 'author', 'editions.editions')->where('editor_id', $idEditor)->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Touts les livres de cette éditeur',
            'livre' => $books
        ]);

    }
}
