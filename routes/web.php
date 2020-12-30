<?php

use Illuminate\Support\Facades\{Route, Auth};
use App\Http\Controllers\{SeriesController, TemporadasController, EpisodiosController, EntrarController, RegistroController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Series
Route::get('/series', [SeriesController::class, 'index'])
    ->name('listar_series');

Route::get('/series/criar', [SeriesController::class, 'create'])
    ->name('form_criar_serie')
    ->middleware('auth');

Route::post('/series/criar', [SeriesController::class, 'store'])
    ->middleware('auth');

Route::delete('/series/{id}', [SeriesController::class, 'destroy'])
    ->middleware('auth');

Route::post('/series/{id}/editaNome', [SeriesController::class, 'editaNome'])
    ->middleware('auth');

// Temporadas
Route::get('/series/{serieId}/temporadas', [TemporadasController::class, 'index']);
Route::get('/temporadas/{temporada}/episodios', [EpisodiosController::class, 'index']);
Route::post('/temporadas/{temporada}/episodios/assistir', [EpisodiosController::class, 'assistir'])
    ->middleware('auth');

// Login
Route::get('/entrar', [EntrarController::class, 'index'])->name('entrar');
Route::post('/entrar', [EntrarController::class, 'entrar']);

// Cadastro
Route::get('/registrar', [RegistroController::class, 'create']);
Route::post('/registrar', [RegistroController::class, 'store']);

// Logout
Route::get('/sair', function () {
    Auth::logout();
    return redirect('entrar');
});
