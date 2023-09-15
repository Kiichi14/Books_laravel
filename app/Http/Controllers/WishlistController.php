<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Http\Requests\LibrairyRequest;

class WishlistController extends Controller
{

    // ajout d'un livre dans la liste de souhait d'un user
    public function store(LibrairyRequest $request) {

        $wishlist = new Wishlist();

        $input = $request->all();

        $wishlist->user_id = $input['user_id'];
        $wishlist->edition_id = $input['edition_id'];

        $wishlist->save();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Votre livre a bien été ajouté a votre liste de souhait'
        ]);
    }

    // capture de la liste de souhait d'un user avec ses relations
    public function show($id) {

        $wishlist = Wishlist::with('user', 'editions.book.category', 'editions.book.author', 'editions.editions')->where('user_id', $id)->get();

        $editions = $wishlist->pluck('editions');

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Détail de la wishlist',
            'result' => [
                'user' => $wishlist->first()->user,
                'wishlist' => $editions
            ]
        ]);
    }

    // suppression d'un livre dans la liste de souhait d'un user
    public function destroy($idUser ,$idBook) {

        $wishlist = Wishlist::where([['user_id', $idUser] ,['edition_id', $idBook]])->delete();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Votre livre a bien été supprimer de votre wishlist'
        ]);

    }

}
