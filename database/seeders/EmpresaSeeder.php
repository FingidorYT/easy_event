<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::create(['id'=>1, 'nit_empresa'=>'111222333', 'direccion_empresa'=>'Floridablanca', 'nombre_empresa'=>'ADSO', 'telefono_empresa'=>'	3173495595', 'email_empresa'=>'adso00@gmail.com', 'estado'=>'pendiente','user_id'=>4]);

        Empresa::create(['id'=>2, 'nit_empresa'=>'222333444', 'direccion_empresa'=>'Bucaramanga', 'nombre_empresa'=>'Ejemplo2', 'telefono_empresa'=>'5555555555', 'email_empresa'=>'ejemplo2@gmail.com','estado'=>'pendiente', 'user_id'=>4]);

        Empresa::create(['id'=>3, 'nit_empresa'=>'333444555', 'direccion_empresa'=>'Girón', 'nombre_empresa'=>'Ejemplo3', 'telefono_empresa'=>'6666666666', 'email_empresa'=>'ejemplo3@gmail.com', 'estado'=>'pendiente','user_id'=>4]);

        Empresa::create(['id'=>4, 'nit_empresa'=>'444555666', 'direccion_empresa'=>'Piedecuesta', 'nombre_empresa'=>'Ejemplo4', 'telefono_empresa'=>'7777777777', 'email_empresa'=>'ejemplo4@gmail.com', 'estado'=>'pendiente','user_id'=>4]);

        Empresa::create(['id'=>5, 'nit_empresa'=>'555666777', 'direccion_empresa'=>'Floridablanca', 'nombre_empresa'=>'Ejemplo5', 'telefono_empresa'=>'8888888888', 'email_empresa'=>'ejemplo5@gmail.com', 'estado'=>'pendiente','user_id'=>4]);

        Empresa::create(['id'=>6, 'nit_empresa'=>'666777888', 'direccion_empresa'=>'Barrancabermeja', 'nombre_empresa'=>'Ejemplo6', 'telefono_empresa'=>'9999999999', 'email_empresa'=>'ejemplo6@gmail.com','estado'=>'pendiente', 'user_id'=>4]);

        Empresa::create(['id'=>7, 'nit_empresa'=>'777888999', 'direccion_empresa'=>'San Gil', 'nombre_empresa'=>'Ejemplo7', 'telefono_empresa'=>'1010101010', 'email_empresa'=>'ejemplo7@gmail.com','estado'=>'pendiente', 'user_id'=>4]);


    }
}
