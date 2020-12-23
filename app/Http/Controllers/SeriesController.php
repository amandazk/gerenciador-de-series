<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use Illuminate\Http\Request;
use App\Models\Serie;
use App\Services\CriadorDeSerie;

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

    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorDeSerie)
    {   // esse nome que o request pega, é o name lá do formulário de create
        // $nome = $request->get('nome');
        // $nome = $request->nome;  o laravel já busca com o método __get
        // $request->validate([ // está no SeriesFormRquest
        //     'nome' => 'required| min:2'
        // ]);
        $serie = $criadorDeSerie->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->ep_por_temporada
        ); 

        $request->session()
            ->flash(
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
