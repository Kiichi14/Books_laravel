<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorStatsController extends Controller
{

    /* Capture de tous le auteurs */
    public function index() {

        $authors = Author::get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Touts les Auteurs',
            'author' => $authors
        ]);

    }

    /* Capture d'un auteur par son id */
    public function show($id) {

        $author = Author::where('id', $id)->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Détail de l\'auteur',
            'author' => $author
        ]);

    }

    /* Moyenne de tous le livres d'un auteur */
    public function averageAuthor($id) {

        $author = Author::with('books', 'books.category', 'books.editor', 'books.rate')->where('id', $id)->get();

        $rate = $author->pluck('rate');

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Touts les livres de l\'auteur',
            'author' => $author,
            'authorRate' => $rate
        ]);

    }

}
