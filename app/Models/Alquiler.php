<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alquiler extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id', 'metodo_pago', 'lugar_entrega', 'fecha_alquiler', 'fecha_devolucion',
    ];
}
