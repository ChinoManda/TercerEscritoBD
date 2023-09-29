<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisionTable extends Migration
{

    public function up()
    {
        Schema::create('revision', function (Blueprint $table) {
            $table->id();
            $table->string("detalle");
            $table->unsignedBigInteger("tarea_id");
            $table->foreign("tarea_id")->references("id")->on("tarea");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('revision');
    }
}
