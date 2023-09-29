<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareaCategoriaTable extends Migration
{

    public function up()
    {
        Schema::create('tarea_categoria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("tarea_id");
            $table->foreign("tarea_id")->references("id")->on("tarea");
            $table->string("categoria");
        });
    }

    public function down()
    {
        Schema::dropIfExists('tarea_categoria');
    }
}
