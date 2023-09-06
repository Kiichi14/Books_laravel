<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReadingStatus;
use App\Http\Requests\ReadingStatusRequest;

class ReadingStatusController extends Controller
{

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

    /* get status des livres d'un utilisateur */
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

}
