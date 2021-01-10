<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Serie extends Model
{
    // protected $table = 'series'; 
    // por padrao, o laravel pega o nome da classe, coloca em minúsculo e no plural
    // entao, nem precisaria informar o nome da tabela, nesse caso
    public $timestamps = false;
    protected $fillable = ['nome', 'capa'];

    public function getCapaUrlAttribute() // mutators
    {
        if ($this->capa) {
            return Storage::url($this->capa);
        }
        return Storage::url('serie/sem-imagem.jpeg');
    }

    // as relações entre tabelas no laravel são feitas através de métodos
    public function temporadas()
    {
        return $this->hasMany(Temporada::class); // uma série tem muitas temporadas
    }
}
