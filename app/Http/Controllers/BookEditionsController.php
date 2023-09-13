<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookEditions;
use App\Http\Requests\BookEditionsRequest;

class BookEditionsController extends Controller
{

    public function __construct() {
        $this->middleware('checkrole:admin')->except(['index', 'show', 'store', 'findAllBookEdition']);
    }

    public function index() {

        $booksEditions = BookEditions::with('book','book.author','book.category', 'editions')->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Touts les livres',
            'livres' => $booksEditions
        ]);

    }

    public function show($id) {

        $bookEdition = BookEditions::with('book','book.author','book.category', 'editions')
                        ->where('id', $id)
                        ->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Détail de l\'édition du livre',
            'livres' => $bookEdition
        ]);
    }

    public function store(BookEditionsRequest $request) {

        $bookEdition = new BookEditions();

        $input = $request->all();

        $bookEdition->book_id = $input['book_id'];
        $bookEdition->edition_id = $input['edition_id'];

        $bookEdition->save();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Votre edition a bien été ajouté',
            'livres' => $bookEdition
        ]);

    }

    public function update(BookEditionsRequest $request, $id) {

        $input = $request->all();

        $bookEdition = BookEditions::where('id', $id)->update([
            'book_id' => $input['book_id'],
            'edition_id' => $input['edition_id']
        ]);

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Votre édition a bien été mis a jour',
            'book' => $bookEdition
        ]);

    }

    public function destroy($id) {

        $bookEdition = BookEditions::where('id', $id)->delete();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Votre livre a bien été supprimer',
        ]);


    }

    public function findAllBookEdition($id) {

        $booksEditions = BookEditions::with('book','book.author','book.category', 'editions')
                        ->where('book_id', $id)
                        ->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Toutes les éditions d\'un livre',
            'livres' => $booksEditions
        ]);

    }

}
