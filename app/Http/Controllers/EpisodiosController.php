<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use App\Models\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index(Temporada $temporada, Request $request) // pra não precisar usar o método find
    {   
        $episodios = $temporada->episodios;
        $temporadaId = $temporada->id;
        $mensagem = $request->session()->get('mensagem');

        return view('episodios.index', 
            compact('episodios', 'temporadaId', 'mensagem'));
    }

    public function assistir(Temporada $temporada, Request $request)
    {
        $episodiosAssistidos = $request->episodios;
        // marca como assistido só se estiver no array
        $temporada->episodios->each(function (Episodio $episodio) use ($episodiosAssistidos){
            $episodio->assistido = in_array(
                $episodio->id,
                $episodiosAssistidos
            );
        });
        $temporada->push(); // envia todas as alterações
        $request->session()->flash('mensagem', 'Episódios marcados como assistidos');

        return redirect()->back(); // redireciona o usuário pra última página visitada
    }

}