<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::query()
            ->orderBy('nome')
            ->get();
        $mensagem = $request->session()->get('mensagem');

        return view('series.index', compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {   // esse nome que o request pega, é o name lá do formulário de create
        // $nome = $request->get('nome');
        // $nome = $request->nome;  o laravel já busca com o método __get
        $request->validate([
            'nome' => 'required| min:2'
        ],
        // [
        //     'nome.required' => 'Esse campo é obrigatório',]
        );
        $serie = Serie::create($request->all());
        $request->session()
            ->flash( // uma mensagem que dura somente uma sessão
                'mensagem',
                "Série {$serie->id} criada com sucesso {$serie->nome}"
            );

        return redirect()->route('listar_series');
    }

    public function destroy(Request $request)
    {
        Serie::destroy($request->id);
        $request->session()
            ->flash( // uma mensagem que dura somente uma sessão
                'mensagem',
                "Série removida com sucesso"
            );

        return redirect()->route('listar_series');
    }
}
