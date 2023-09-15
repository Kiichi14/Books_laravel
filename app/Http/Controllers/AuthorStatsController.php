<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Books;
use Illuminate\Contracts\Database\Eloquent\Builder;

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

        $book = $author->first()->books;

        $rate = $book->pluck('rate');

        foreach($rate as $rateAvg) {
            $average = $rateAvg->pluck('rate')->avg();
        }

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Touts les livres de l\'auteur',
            'author' => $author,
            'authorRate' => $average
        ]);

    }

    /* Nombre de livre en cours de lecture (non finie) */
    public function bookInRead($idAuthor) {

        $author = Books::with('author', 'editions.readingStatus')
        ->whereRelation('editions.readingStatus', 'status', 'En cours de lecture')
        ->where('author_id', $idAuthor)
        ->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Livre en cours de lecture',
            'livre' => $author,
            'nombre de livre' => ''
        ]);

    }

}
