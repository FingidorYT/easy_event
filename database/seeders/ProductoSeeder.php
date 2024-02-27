<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::create(['id'=>1, 'codigo'=>1, 'precio'=>19.99, 'nombre_producto'=>'Producto A', 'descripcion'=>'prueba','cantidad_disponible'=>50, 'cantidad_inventario'=>50, 'empresa_id'=>1, 'categoria_id'=>1]);

        Producto::create(['id'=>2, 'codigo'=>2, 'precio'=>29.99, 'nombre_producto'=>'Producto B', 'descripcion'=>'prueba','cantidad_disponible'=>30, 'cantidad_inventario'=>30, 'empresa_id'=>1, 'categoria_id'=>1]);

        Producto::create(['id'=>3, 'codigo'=>3, 'precio'=>14.99, 'nombre_producto'=>'Producto C', 'descripcion'=>'prueba','cantidad_disponible'=>25, 'cantidad_inventario'=>25, 'empresa_id'=>1, 'categoria_id'=>1]);

        Producto::create(['id'=>4, 'codigo'=>4, 'precio'=>39.99, 'nombre_producto'=>'Producto D', 'descripcion'=>'prueba','cantidad_disponible'=>40, 'cantidad_inventario'=>40, 'empresa_id'=>1, 'categoria_id'=>1]);

        Producto::create(['id'=>5, 'codigo'=>5, 'precio'=>9.99, 'nombre_producto'=>'Producto E', 'descripcion'=>'prueba','cantidad_disponible'=>20, 'cantidad_inventario'=>20, 'empresa_id'=>1, 'categoria_id'=>1]);

        Producto::create(['id'=>6, 'codigo'=>6, 'precio'=>49.99, 'nombre_producto'=>'Producto F', 'descripcion'=>'prueba','cantidad_disponible'=>35, 'cantidad_inventario'=>35, 'empresa_id'=>1, 'categoria_id'=>1]);

        Producto::create(['id'=>7, 'codigo'=>7, 'precio'=>24.99, 'nombre_producto'=>'Producto G', 'descripcion'=>'prueba','cantidad_disponible'=>45, 'cantidad_inventario'=>45, 'empresa_id'=>1, 'categoria_id'=>1]);

        Producto::create(['id'=>8, 'codigo'=>8, 'precio'=>34.99, 'nombre_producto'=>'Producto H', 'descripcion'=>'prueba','cantidad_disponible'=>15, 'cantidad_inventario'=>15, 'empresa_id'=>1, 'categoria_id'=>1]);

        Producto::create(['id'=>9, 'codigo'=>9, 'precio'=>17.99, 'nombre_producto'=>'Producto I', 'descripcion'=>'prueba','cantidad_disponible'=>22, 'cantidad_inventario'=>22, 'empresa_id'=>1, 'categoria_id'=>1]);

        Producto::create(['id'=>10, 'codigo'=>10, 'precio'=>27.99, 'nombre_producto'=>'Producto J', 'descripcion'=>'prueba','cantidad_disponible'=>18, 'cantidad_inventario'=>18, 'empresa_id'=>1, 'categoria_id'=>1]);

        Producto::create(['id'=>11, 'codigo'=>11, 'precio'=>12.99, 'nombre_producto'=>'Producto K', 'descripcion'=>'prueba','cantidad_disponible'=>33, 'cantidad_inventario'=>33, 'empresa_id'=>1, 'categoria_id'=>1]);

        Producto::create(['id'=>12, 'codigo'=>12, 'precio'=>42.99, 'nombre_producto'=>'Producto L', 'descripcion'=>'prueba','cantidad_disponible'=>28, 'cantidad_inventario'=>28, 'empresa_id'=>1, 'categoria_id'=>1]);

        Producto::create(['id'=>13, 'codigo'=>13, 'precio'=>22.99, 'nombre_producto'=>'Producto M', 'descripcion'=>'prueba','cantidad_disponible'=>12, 'cantidad_inventario'=>12, 'empresa_id'=>1, 'categoria_id'=>1]);

        Producto::create(['id'=>14, 'codigo'=>14, 'precio'=>32.99, 'nombre_producto'=>'Producto N', 'descripcion'=>'prueba','cantidad_disponible'=>38, 'cantidad_inventario'=>38, 'empresa_id'=>1, 'categoria_id'=>1]);

        Producto::create(['id'=>15, 'codigo'=>15, 'precio'=>15.99, 'nombre_producto'=>'Producto O', 'descripcion'=>'prueba','cantidad_disponible'=>26, 'cantidad_inventario'=>26, 'empresa_id'=>1, 'categoria_id'=>1]);

        Producto::create(['id'=>16, 'codigo'=>16, 'precio'=>45.99, 'nombre_producto'=>'Producto P', 'descripcion'=>'prueba','cantidad_disponible'=>17, 'cantidad_inventario'=>17, 'empresa_id'=>1, 'categoria_id'=>1]);

        Producto::create(['id'=>17, 'codigo'=>17, 'precio'=>29.99, 'nombre_producto'=>'Producto Q', 'descripcion'=>'prueba','cantidad_disponible'=>23, 'cantidad_inventario'=>23, 'empresa_id'=>1, 'categoria_id'=>1]);

        Producto::create(['id'=>18, 'codigo'=>18, 'precio'=>37.99, 'nombre_producto'=>'Producto R', 'descripcion'=>'prueba','cantidad_disponible'=>42, 'cantidad_inventario'=>42, 'empresa_id'=>1, 'categoria_id'=>1]);

        Producto::create(['id'=>19, 'codigo'=>19, 'precio'=>19.99, 'nombre_producto'=>'Producto S', 'descripcion'=>'prueba','cantidad_disponible'=>31, 'cantidad_inventario'=>31, 'empresa_id'=>1, 'categoria_id'=>1]);



    }
}
