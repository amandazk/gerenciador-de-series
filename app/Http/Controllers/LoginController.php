<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        // realizar login: salva na sessão esses dados
        // vai tentar encontrar no banco de dados, um usuário com esse email e senha
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return redirect()->back()->withErrors('Erro ao se autenticar');
        }

        return redirect()->route('listar_series');

    }
}
