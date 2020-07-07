<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParroquiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parroquias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('municipio_id');
            $table->string('parroquia');
            $table->foreign("municipio_id")
                  ->references('id')->on('municipios');
            $table->timestamps();
        });

        // Creación de la Vista view_discapacidad
        DB::statement('CREATE OR REPLACE VIEW view_parroquia AS
                          SELECT
                          p.id,
                          p.parroquia,
                          p."municipio_id",
                          m.municipio,
                          m."estado_id",
                          e.estado
                          FROM parroquias p
                          INNER JOIN municipios m
                          ON m.id = p."municipio_id"
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
        DB::statement("DELETE VIEW view_parroquia");

        Schema::dropIfExists('parroquias');
    }
}
