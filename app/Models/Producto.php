<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo', 'precio', 'nombre', 'cantidad_disponible', 'cantidad_inventario', 'categoria_id', 'empresa_id'
    ];

}
