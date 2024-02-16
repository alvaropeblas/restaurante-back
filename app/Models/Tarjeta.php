<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    use HasFactory;


    protected $fillable = [
        'n_tarjeta',
        'f_vencimiento',
        'cvv',
        'user_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
