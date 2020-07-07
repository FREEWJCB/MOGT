<?php

use Illuminate\Database\Seeder;
use App\Alergia;
use App\tipo_alergia;

class AlergiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

 public function run()
     {
         $tipoAlergia = new tipo_alergia();
         $tipoAlergia->name = "Respiratoria";
         $tipoAlergia->save();

         $tipoAlergia = new tipo_alergia();
         $tipoAlergia->name = "Dérmica";
         $tipoAlergia->save();

         $tipoAlergia = new tipo_alergia();
         $tipoAlergia->name = "Alimentaria";
         $tipoAlergia->save();

         $tipoAlergia = new tipo_alergia();
         $tipoAlergia->name = "Medicamento";
         $tipoAlergia->save();

         DB::statement("SELECT setval(pg_get_serial_sequence('tipo_alergias', 'id'), coalesce(max(id)+1,1), false) FROM tipo_alergias;");

         $libro = new Alergia();
         $libro->nombre = "Rinitis";
         $libro->descripcion = "Inflamación del revestimiento mucoso de la nariz";
         $libro->tipoAlergia_id = 1;
         $libro->save();

         $libro = new Alergia();
         $libro->nombre = "Asma";
         $libro->descripcion = "Afección en la que las vías respiratorias de una persona se inflaman, estrechan y producen mayores cantidades de mucosa de lo normal";
         $libro->tipoAlergia_id = 1;
         $libro->save();

         $libro = new Alergia();
         $libro->nombre = "Cactus";
         $libro->descripcion = "Piel irritada";
         $libro->tipoAlergia_id = 2;
         $libro->save();

         $libro = new Alergia();
         $libro->nombre = "Mariscos";
         $libro->descripcion = "Malestar general e inflamación de la tráquea";
         $libro->tipoAlergia_id = 3;
         $libro->save();

         $libro = new Alergia();
         $libro->nombre = "Ibuprofeno";
         $libro->descripcion = "Malestar general e inflamación de la tráquea";
         $libro->tipoAlergia_id = 4;
         $libro->save();

        // Solucionando error de la id
        DB::statement("SELECT setval(pg_get_serial_sequence('alergias', 'id'), coalesce(max(id)+1,1), false) FROM alergias;");
        // El error sucede ya que postgresql al solo implantarle datos sin espicifarle que incremente la id
        // postgresql hara como que la id sigue siendo 1
     }
}
