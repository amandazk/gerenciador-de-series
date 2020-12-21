<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = [
            'Dexter',
            'House md',
            'Lost',
            'The Mandalorian'
        ];

        return view('series.index', compact('series'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {   // esse nome que o request pega, é o name lá do formulário de create
        // $nome = $request->get('nome');
        $nome = $request->nome; // o laravel já busca com o método __get
        $serie = new Serie();
        $serie->nome = $nome;
        var_dump($serie->save());
    }
}
