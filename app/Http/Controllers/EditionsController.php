<?php

namespace App\Http\Controllers;
use App\Models\Editions;

use Illuminate\Http\Request;

class EditionsController extends Controller
{

    public function index() {

        $editions = Editions::get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Touts les editions',
            'editions' => $editions
        ]);

    }

    public function find($id) {

        $edition = Editions::where('id', $id)->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Touts les editions',
            'editions' => $edition
        ]);

    }

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

}
