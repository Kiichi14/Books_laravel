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

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Votre livre a bine été ajouté',
            'livre' => $book
        ]);

    }
}
