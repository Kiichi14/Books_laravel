<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use App\Http\Requests\CommentsRequest;

class CommentsController extends Controller
{

    public function index() {

        $comments = Comments::with('book', 'user')->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'touts les commentaires',
            'livres' => $comments
        ]);

    }

    public function store(CommentsRequest $request) {

        $comment = new Comments();

        $input = $request->all();

        $comment->comment = $input['comment'];
        $comment->rate = $input['rate'];
        $comment->user_id = $input['user_id'];
        $comment->book_id = $input['book_id'];

        $comment->save();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'votre commentaires a bien été ajouté'
        ]);

    }

    public function show($book_id) {

        $comments = Comments::with('user', 'book', 'book.author', 'book.category')->where('book_id', $book_id)->get();

        $book = $comments->first()->book;

        $average = $comments->pluck('rate')->avg();

        foreach($comments as $comment) {
            unset($comment['book']);
        }

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Touts les commentaires de ce livre',
            'book' => $book,
            'comment' => $comments,
            'average' => $average
        ]);

    }

}
