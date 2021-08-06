<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialTable extends Migration
{
    public function up()
    {
        Schema::create('historials', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('detalle');
            $table->string('tecnico');
            $table->unsignedBigInteger('producto');
            $table->foreign('producto')->references('id')->on('productos');
            $table->string('estado');
            $table->timestamps();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('historials');
    }
}
