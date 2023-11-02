<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlquilersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alquilers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id');
            $table->foreign('usuario_id')->reference('id')->on('users');
            $table->integer('id_alquiler');
            $table->string('metodo_pago');
            $table->string('lugar_entrega');
            $table->date('fecha_alquiler');
            $table->date('fecha_devolucion');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alquilers');
    }
}
