<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo');
            $table->bigInteger('precio');
            $table->string('nombre_producto');
            $table->integer('cantidad_disponible');
            $table->integer('cantidad_inventario');
            $table->foreignId('empresas_id'); 
            $table->foreign('empresas_id')->references('id')->on('empresas');
            $table->foreignId('categorias_id'); 
            $table->foreign('categorias_id')->references('id')->on('categorias');

            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
