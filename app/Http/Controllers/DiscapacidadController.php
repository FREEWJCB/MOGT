<?php

namespace App\Http\Controllers;

use App\Discapacidad;
use App\Tipo_discapacidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class DiscapacidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){ // si es por una etición ajax

          $nombre = $request->get('buscar');

          $pag = $request->pag;

          // Se obtiene los datos de la Vista view_discapacidad
          $discapacidades = DB::table('view_discapacidad')
          ->where('discapacidad','like',"%$nombre%")->orderBy('id','desc')
          ->skip(($pag * 6) - 6) //skip() para saltar entre la consulta
          ->take(6) //para limitar el resultado
          ->get();

          $tipos_d = Tipo_discapacidad::all();

          return compact('discapacidades', 'tipos_d');

        } else { // si no se redirige a index

          return view('/theme/index');

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos_d = Tipo_discapacidad::all();
        return view('discapacidad.create', compact('tipos_d'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){  // si es por una petición ajax

          $request->validate([
            'discapacidad' => 'required',
            'descripciones' => 'required',
            'tipoDiscapacidad_id' => 'required',
          ]);

          $discapacidad = new Discapacidad();
          $discapacidad->discapacidad = $request->discapacidad;
          $discapacidad->descripciones = $request->descripciones;
          $discapacidad->tipoDiscapacidad_id = $request->tipoDiscapacidad_id;
          $discapacidad->save();

          return $discapacidad;

        } else { // si no se redirige a index

          return view('/theme/index');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipos_d = tipo_discapacidad::all();

        $where = array('id' => $id);
        $data['discapacidad_info'] = Discapacidad::where($where)->first();

        return view('discapacidad.edit',compact('tipos_d'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->ajax()){  // si es por una petición ajax

          $request->validate([
            'discapacidad' => 'required',
            'descripciones' => 'required',
            'tipoDiscapacidad_id' => 'required',
          ]);

          $update = [ 'discapacidad' => $request->discapacidad,
          'descripciones' => $request->descripciones,
          'tipoDiscapacidad_id' => $request->tipoDiscapacidad_id,
        ];
        $discapacidad = Discapacidad::where('id',$id)->update($update);

        return $discapacidad;

        } else { // si no se redirige a index

          return view('/theme/index');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if($request->ajax()){  // si es por una petición ajax

        try {
          //Eliminar registro
          $discapacidad = Discapacidad::where('id',$id)->delete();
          return $discapacidad;
        }
        catch (\Exception $e) {
          return response()->json([
            'status' => 'Ocurrio un error!',
            'msg' => 'No puede ser eliminada, está siendo usada.',
          ],400);
        }

      } else { // si no se redirige a index

        return view('/theme/index');

      }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contar(Request $request)
    {
        if($request->ajax()){  // si es por una petición ajax

            $data = Discapacidad::all()->count();

            return $data;
        } else { // si no se redirige a index

          return view('/theme/index');

        }
    }
}
