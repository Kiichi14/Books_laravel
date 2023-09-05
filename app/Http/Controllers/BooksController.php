<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Http\Requests\CreateBooksRequest;

class BooksController extends Controller
{
    public function index() {

        $books = Books::with('category', 'editor', 'author')->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Touts les livres',
            'livres' => $books
        ]);

        //return view('dashboard', ['books' => $books]);

    }

    public function show($id) {

        $book = Books::with('category', 'editor', 'author')->where('id', $id)->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'livres uniques',
            'livre' => $book
        ]);
    }

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

    /* Méthode de recherche */

    public function searchByauthor($idAuthor) {

        $books = Books::with('category', 'editor', 'author', 'editions.editions')->where('author_id', $idAuthor)->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Touts les livres de l\'auteur',
            'livre' => $books
        ]);

    }

    public function searchByCategory($idCategory) {

        $books = Books::with('category', 'editor', 'author', 'editions.editions')->where('category_id', $idCategory)->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Touts les livres de cette catégorie',
            'livre' => $books
        ]);

    }

    public function searchByEditor($idEditor) {

        $books = Books::with('category', 'editor', 'author', 'editions.editions')->where('editor_id', $idEditor)->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Touts les livres de cette éditeur',
            'livre' => $books
        ]);

    }
}
