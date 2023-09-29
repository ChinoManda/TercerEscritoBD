<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareaTable extends Migration
{

    public function up()
    {
        Schema::create('tarea', function (Blueprint $table) {
            $table->id();
            $table->string("titulo");
            $table->string("contenido");
            $table->unsignedBigInteger("usuario_id");
            $table->foreign("usuario_id")->references("id")->on("usuario");
            $table->string("estado");
            $table->string("autor");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tarea');
    }
}
