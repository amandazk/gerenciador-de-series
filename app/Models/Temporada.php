<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    public function episodios()
    {
        return $this->hasMany(Episodio::class); // temporada tem muitos episódios
    }

    public function serie() // no singular, pois a temporada pertence a UMA série
    {
        return $this->belongsTo(Serie::class);
    }
}
