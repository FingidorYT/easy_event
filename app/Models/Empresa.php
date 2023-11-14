<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    public $timestamp = false;

    protected $fillable = [
        'nit_empresa', 'direccion_empresa', 'nombre_empresa', 'telefono_empresa', 'email_empresa', 'user_id'
    ];

    public function user () {
        return $this->belongsTo(User::class, 'user_id', 'id');   
    }
}
