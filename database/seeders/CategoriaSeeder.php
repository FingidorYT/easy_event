<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create(['id'=>1, 'nombre'=>'Sillas']);
        Categoria::create(['id'=>2, 'nombre'=>'Mesas']);
        Categoria::create(['id'=>3, 'nombre'=>'Luces']);
        Categoria::create(['id'=>4, 'nombre'=>'Sonido']);
        Categoria::create(['id'=>5, 'nombre'=>'Mantel']);
        Categoria::create(['id'=>6, 'nombre'=>'Tarima']);
        Categoria::create(['id'=>7, 'nombre'=>'Alfombra']);
        Categoria::create(['id'=>8, 'nombre'=>'Bases']);
        Categoria::create(['id'=>9, 'nombre'=>'CandyBar']);
        Categoria::create(['id'=>10, 'nombre'=>'Menaje']);
        

    }
}
