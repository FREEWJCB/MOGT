<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('estado_id');
            $table->string('municipio');
            $table->foreign("estado_id")
                  ->references('id')->on('estados');
            $table->timestamps();
        });

        // Creación de la Vista view_discapacidad
        DB::statement('CREATE OR REPLACE VIEW view_municipio AS
                          SELECT
                          m.id,
                          m.municipio,
                          m."estado_id",
                          e.estado
                          FROM municipios m
                          INNER JOIN estados e
                          ON e.id = m."estado_id";
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
        DB::statement("DELETE VIEW view_municipio");

        Schema::dropIfExists('municipios');
    }
}
