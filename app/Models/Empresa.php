<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nit_empresa', 'direccion_empresa', 'nombre_empresa', 'telefono_empresa', 'email_empresa', 'users_id'
    ];


}
