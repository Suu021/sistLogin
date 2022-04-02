<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DateTime;


class LoginController extends Controller
{
    public function create(Request $request){

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $token = $user->createToken('Logado!'); //caso apareça um erro aqui no "createToken", ignore. A API ta rodando normal!

            return response()->json($token->plainTextToken, 200);
        }

        return response()->json('Usuario invalido', 401);

    }

    public function store(Request $request){

        $cadastro = new User;

        $cadastro->name = $request->name;
        $cadastro->email = $request->email;
        $cadastro->password = $request->password;
        $cadastro['password'] = bcrypt($cadastro['password']);

        $cadastro -> save();
    }
}
