<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use App\Http\Requests\CommentsRequest;

class CommentsController extends Controller
{

    /* Mise en place du middleware pour bloquer les méthodes update, destroy */
    public function __construct() {
        $this->middleware('checkrole:admin')->except(['index', 'show', 'store']);
    }

    // Capture de tous les commentaires avec leurs relations
    public function index() {

        $comments = Comments::with('book', 'user')->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'touts les commentaires',
            'livres' => $comments
        ]);

    }

    // ajout d'un commentaire
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

    // capture des comentaires d'un seul livre
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

    // mise a jour d'un commentaire
    public function update(CommentsRequest $request, $id) {

        $input = $request->all();

        $comment = Comments::where('id', $id)->update([
            'comment' => $input['comment'],
            'rate' => $input['rate'],
            'user_id' => $input['user_id'],
            'book_id' => $input['book_id']
        ]);

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Votre commentaire a bien été mis a jour',
            'book' => $comment
        ]);

    }

    // suppression d'un commentaire
    public function destroy($id) {

        $comment = Comments::where('id', $id)->delete();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Le commentaire a bien été supprimer',
            'book' => $comment
        ]);

    }

}
