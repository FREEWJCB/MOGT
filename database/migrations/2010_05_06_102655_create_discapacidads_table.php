<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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

        // Creación de la Vista view_discapacidad
        DB::statement('CREATE OR REPLACE VIEW view_discapacidad AS
                          SELECT
                          dis.id,
                          dis.discapacidad,
                          dis.descripciones,
                          dis."tipoDiscapacidad_id",
                          td.tipo_d
                          FROM discapacidads dis
                          INNER JOIN tipo_discapacidads td
                          ON td.id = dis."tipoDiscapacidad_id";
                      ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Eliminar Vista view_discapacidad
        DB::statement("DELETE VIEW view_discapacidad");

        Schema::dropIfExists('discapacidads');
    }
}
