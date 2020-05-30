<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscapacidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discapacidads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('discapacidad', 50)->unique();
            $table->string('descripciones', 300);
            $table->unsignedBigInteger('tipoDiscapacidad_id');
            $table->foreign('tipoDiscapacidad_id')->references('id')->on('tipo_discapacidads');
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
        Schema::dropIfExists('discapacidads');
    }
}
