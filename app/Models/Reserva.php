<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    protected $table = 'reservas';

    protected $fillable = [

        'fecha',
        'hora',
        'n_personas',
        'menu',
        'alergias',
        'userid',
    ];
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
