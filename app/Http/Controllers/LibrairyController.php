<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Librairy;
use App\Http\Requests\LibrairyRequest;

class LibrairyController extends Controller
{

    // ajout d'un livre dans la bibliothéque d'un user
    public function store(LibrairyRequest $request) {

        $librairy = new Librairy();

        $input = $request->all();

        $librairy->user_id = $input['user_id'];
        $librairy->edition_id = $input['edition_id'];

        $librairy->save();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Votre livre a bien été ajouté a votre bibliothéque'
        ]);

    }

    // Capture de la bibliothéque d'un user avec toutes ses relations
    public function show($id) {

        $librairy = Librairy::with('user', 'editions.book.category', 'editions.book.author', 'editions.editions')->where('user_id', $id)->get();

        $editions = $librairy->pluck('editions');

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Détail de la bibliothéque',
            'result' => [
                'user' => $librairy->first()->user,
                'bibliothéque' => $editions
            ]
        ]);

    }

    // suppression d'un livre dans la bibliothéque d'un user
    public function destroy($idUser, $idBook) {

        $librairy = Librairy::where([['user_id', $idUser], ['edition_id', $idBook]])->delete();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Votre livre a bien été supprimer de votre bibliothéque'
        ]);

    }

}
