<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAlergiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alergias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50)->unique();
            $table->string('descripcion', 300);
            $table->unsignedBigInteger('tipoAlergia_id');
            $table->foreign('tipoAlergia_id')->references('id')->on('tipo_alergias');
            $table->timestamps();
        });

        // Creación de la Vista view_alergia
        DB::statement('CREATE OR REPLACE VIEW view_alergia AS
                          SELECT
                          a.id,
                          a.nombre,
                          a.descripcion,
                          a."tipoAlergia_id",
                          ta.name
                          FROM alergias a
                          INNER JOIN tipo_alergias ta
                          ON ta.id = a."tipoAlergia_id";
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
        DB::statement("DELETE VIEW view_alergia");

        Schema::dropIfExists('alergias');
    }
}
