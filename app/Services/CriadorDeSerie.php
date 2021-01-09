<?php

namespace App\Services;

use App\Models\Serie;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criarSerie(
        string $nomeSerie,
        int $qtdTemporadas,
        int $epPorTemporada,
        ?string $capa // obrigatório ser passado, mas pode não ser uma string
    ): Serie {
        $serie = null;
        DB::beginTransaction();
        $serie = Serie::create([
            'nome' => $nomeSerie,
            'capa' => $capa
        ]);
        $this->criaTemporadas($qtdTemporadas, $epPorTemporada, $serie);
        DB::commit();
        // for ($i = 1; $i <= $qtdTemporadas; $i++) {
        //     $temporada = $serie->temporadas()->create(['numero' => $i]);

        //     for ($j = 1; $j <= $epPorTemporda; $j++) {
        //         $temporada->episodios()->create(['numero' => $j]);
        //     }
        // }

        return $serie;
    }

    private function criaTemporadas(int $qtdTemporadas, int $epPorTemporada, Serie $serie)
    {
        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            $this->criaEpisodios($epPorTemporada, $temporada);
        }
    }

    private function criaEpisodios(int $epPorTemporada, \Illuminate\Database\Eloquent\Model $temporada): void

    {

        for ($j = 1; $j <= $epPorTemporada; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}
