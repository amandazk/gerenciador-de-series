<?php

namespace Tests\Unit;

use App\Models\Serie;
use App\Services\CriadorDeSerie;
use Tests\TestCase;
use Illuminate\Foundation\Testing\{RefreshDatabase, WithFaker};

class CriadorDeSerieTest extends TestCase
{
    use RefreshDatabase; // para usar o banco de dados em memória

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
