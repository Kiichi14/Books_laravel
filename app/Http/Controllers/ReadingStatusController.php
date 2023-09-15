<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReadingStatus;
use App\Http\Requests\ReadingStatusRequest;

class ReadingStatusController extends Controller
{

    // ajout d'un nouveau statut de lecture a une edition possédé par un user
    public function store(ReadingStatusRequest $request) {

        $readingStatus = new ReadingStatus();

        $input = $request->all();

        $readingStatus->status = $input['status'];
        $readingStatus->user_id = $input['user_id'];
        $readingStatus->edition_id = $input['edition_id'];

        $readingStatus->save();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Votre statut a bien été pris en compte'
        ]);

    }

    /* cpature du status des livres d'un user */
    public function show($userId) {

        $status = ReadingStatus::with('user', 'edition.book', 'edition.book.author', 'edition.book.category')->where('user_id', $userId)->get();

        $user = $status->first()->user;

        foreach($status as $statu) {
            unset($statu['user']);
        }

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Statut de tous vos livres',
            'user' => $user,
            'status' => $status
        ]);

    }

    // mise a jour d'un statut de lecture pour une edition d'un user
    public function update(Request $request, $id) {

        $input = $request->all();

        $book = ReadingStatus::where('id', $id)->update([
            'user_id' => $input['user_id'],
            'edition_id' => $input['edition_id'],
            'status' => $input['status']
        ]);

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Le statut de lecture a bien été mis a jour',
        ]);

    }

}
