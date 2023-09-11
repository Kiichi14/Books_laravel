<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LogUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserApiAuthetification extends Controller
{

    public function store(CreateUserRequest $request) {

        $user = new User();

        $input = $request->all();

        $password = $input['password'];

        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = Hash::make($password);

        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        $cookie = cookie('auth_token', $token, 60 * 24 * 7);

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Votre enregistrement a bien été pris en compte',
            'user' => $user,
        ])->withCookie($cookie);

    }

    public function login(LogUserRequest $request) {

        if(auth()->attempt($request->only(['email', 'password']))){

            /** @var \App\Models\MyUserModel $user **/
            $user = auth()->user();

            $token = $user->createToken('security_key')->plainTextToken;

            $cookie = cookie('security_key', $token, 60 * 24 * 7);

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Utilisateur connecté',
                'user' => $user,
                'token' => $token
            ])->withCookie($cookie);

        }else {

            return response()->json([
                'status_code' => 403,
                'status_message' => 'Information non valide',
            ]);
        }

    }

    public function logout() {

        /** @var \App\Models\MyUserModel $user **/
        $user = auth()->user();
        $user->tokens()->delete();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Utilisateur déconnecté',
        ]);

    }

    public function show(Request $request) {


        if(Auth::user()) {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Utilisateur en cours',
                'connected' => 'true',
                'user' => $request->user(),
                'token' => request()->bearerToken(),
                'role' => Auth::user()->role
            ]);
        } else {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Utilisateur non connecté',
                'connected' => 'false',
            ]);
        }

    }

}
