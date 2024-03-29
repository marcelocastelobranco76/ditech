<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $fillable = ['nome', 'descricao'];
   
    public function reserva()
    {
     return $this->belongsTo(Reserva::class);
    }
}
