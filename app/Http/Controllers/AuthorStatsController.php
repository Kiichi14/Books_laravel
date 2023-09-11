<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorStatsController extends Controller
{

    public function index() {

        $authors = Author::get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Touts les Auteurs',
            'author' => $authors
        ]);

    }

    public function show($id) {

        $author = Author::where('id', $id)->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Détail de l\'auteur',
            'author' => $author
        ]);

    }

    public function averageAuthor() {
        //
    }

}
