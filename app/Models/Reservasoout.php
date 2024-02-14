<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasoout extends Model
{
    use HasFactory;
    protected $table = 'reservasout';

    protected $fillable = [
        'name',
        'apellidos',
        'email',
        'fecha',
        'hora',
        'n_personas',
        'menu',
        'alergias',
    ];
}
