<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    // protected $table = 'series'; 
    // por padrao, o laravel pega o nome da classe, coloca em minúsculo e no plural
    // entao, nem precisaria informar o nome da tabela, nesse caso
    public $timestamps = false;
    protected $fillable = ['nome'];
}
