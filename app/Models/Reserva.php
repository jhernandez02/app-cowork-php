<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = [
        'user_id',
        'sala_id',
        'fecha',
        'hora',
        'estado',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }
}
