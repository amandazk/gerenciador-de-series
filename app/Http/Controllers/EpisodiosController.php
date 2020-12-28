<?php

namespace App\Http\Controllers;

use App\Models\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index(Temporada $temporada) // pra não precisar usar o método find
    {   
        $episodios = $temporada->episodios;

        return view('episodios.index', compact('episodios'));
    }

}