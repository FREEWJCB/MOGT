<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->date("fecha_nacimiento");
            $table->unsignedBigInteger('lugar_nacimiento');
            $table->string('descripcion');
            $table->unsignedBigInteger('persona_id');
            $table->foreign("lugar_nacimiento")
                  ->references('id')->on('direccions')
                  ->onDelete('cascade');
            $table->foreign("persona_id")
                  ->references('id')->on('personas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudiantes');
    }
}
