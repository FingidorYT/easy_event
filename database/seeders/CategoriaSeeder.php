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
        Categoria::create(['id'=>1, 'nombre'=>'Sillas', 'descripcion'=>'']);
        Categoria::create(['id'=>2, 'nombre'=>'Mobiliario de Lujo para Eventos', 'descripcion'=>'Mobiliario elegante y lujoso para eventos especiales']);
        Categoria::create(['id'=>3, 'nombre'=>'Iluminación Especial para Eventos', 'descripcion'=>'Sistemas de iluminación diseñados para crear ambientes únicos en eventos']);
        Categoria::create(['id'=>4, 'nombre'=>'Decoración Temática para Eventos', 'descripcion'=>'Artículos decorativos para tematizar y personalizar eventos']);
        Categoria::create(['id'=>5, 'nombre'=>'Catering y Utensilios para Eventos', 'descripcion'=>'Equipamiento y utensilios para servicios de catering en eventos']);
        Categoria::create(['id'=>6, 'nombre'=>'Audiovisual y Tecnología para Eventos', 'descripcion'=>'Sistemas audiovisuales y tecnológicos para mejorar la experiencia en eventos']);
        Categoria::create(['id'=>7, 'nombre'=>'Alfombras y Tapices para Eventos', 'descripcion'=>'Alfombras y tapices diseñados para eventos, aportando comodidad y estilo']);

        

    }
}
