<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = ['user_id', 'sala_id', 'hora_inicio', 'hora_fim'];

    public function salas()
    {
     return $this->hasMany(Sala::class);
    }
}
