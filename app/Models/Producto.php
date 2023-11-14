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

    public function categoria () {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }
    
    public function productosHasAlquiler() {
        return $this->hasMany(AlquilerHasProducto::class, 'producto_id', 'id');
    }

    public function favorito() {
        return $this->hasMany(Favorito::class, 'producto_id', 'id');

    }

}
