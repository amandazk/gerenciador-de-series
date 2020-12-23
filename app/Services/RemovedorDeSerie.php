<?php

namespace App\Services;

use App\Models\{Serie, Temporada, Episodio};
use Illuminate\Support\Facades\DB;

class RemovedorDeSerie
{
    public function removerSerie(int $serieId): string
    {
        $nomeSerie = '';
        // para garantir a integridade do banco
        DB::transaction(function () use ($serieId, &$nomeSerie) {
            $serie = Serie::find($serieId);
            $nomeSerie = $serie->nome;

            $this->removerTemporadas($serie);
            $serie->delete();

        });

        return $nomeSerie;
    }
      
    private function removerTemporadas(Serie $serie): void
    {
        // each() -> para cada uma dessas temporadas, ele vai executar
        // uma função, passando como parãmetro, a temporada
        $serie->temporadas->each(function (Temporada $temporada) {

            $this->removerEpisodios($temporada);
            $temporada->delete();
        });
    }

    private function removerEpisodios(Temporada $temporada): void
    {
        $temporada->episodios()->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }
}
