<?php

namespace Tests\Unit;

use App\Models\Serie;
use App\Services\CriadorDeSerie;
use Tests\TestCase;

class CriadorDeSerieTest extends TestCase
{
    public function testCriarSerie()
    {
        $criadorDeSerie = new CriadorDeSerie();
        $nomeSerie = 'Teste série';
        $numeroTemporadas = 1;
        $numeroEpisodios = 1;
        $serieCriada = $criadorDeSerie->criarSerie($nomeSerie, $numeroTemporadas, $numeroEpisodios);

        $this->assertInstanceOf(Serie::class, $serieCriada);
        $this->assertDatabaseHas('series', ['nome' => $nomeSerie]);
        $this->assertDatabaseHas(
            'temporadas',
            [
                'serie_id' => $serieCriada->id,
                'numero' => $numeroTemporadas
            ]
        );
        $this->assertDatabaseHas('episodios', ['numero' => $numeroEpisodios]);
    }
}
