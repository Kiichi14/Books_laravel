<?php

namespace App\Http\Controllers;
use App\Models\Editions;

use Illuminate\Http\Request;

class EditionsController extends Controller
{

    // capture de tous les editeur
    public function index() {

        $editions = Editions::get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Touts les editions',
            'editions' => $editions
        ]);

    }

    // capture d'un editeur par son id
    public function show($id) {

        $edition = Editions::where('id', $id)->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Touts les editions',
            'editions' => $edition
        ]);

    }

    // ajout d'un nouvel editeur
    public function store(Request $request) {

        $edition = new Editions();

        $input = $request->all();

        $edition->editions_name = $input['editions_name'];
        $edition->editions_format = $input['editions_format'];

        $edition->save();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Votre edition a bien été créé',
            'edition' => $edition
        ]);

    }

    // mise a jour d'un editeur
    public function update(Request $request, $id) {

        $input = $request->all();

        $edition = Editions::where('id', $id)->update([
            'editions_name' => $input['editions_name'],
            'editions_format' => $input['editions_format']
        ]);

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Votre editions a bien été mis a jour',
            'book' => $edition
        ]);

    }

    // suppression d'un editeur
    public function destroy($id) {

        $edition = Editions::where('id', $id)->delete();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Votre edition a bien été supprimer'
        ]);

    }

}
