<?php

namespace App\Http\Controllers;

use App\Parroquia;
use App\Municipio;
use App\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class ParroquiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
          $nombre = $request->get('buscar');

          $pag = $request->pag;

          // Se obtiene los datos de la Vista view_parroquia
          $parroquia = DB::table('view_parroquia')
          ->where('parroquia','like',"%$nombre%")->orderBy('id','desc')
          ->skip(($pag * 6) - 6) //skip() para saltar entre la consulta
          ->take(6) //para limitar el resultado
          ->get();

          $estado = Estado::all();

          return compact('parroquia', 'estado');
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
      $estados = Estado::all();
      $estado_id = 0;
      $municipios = Municipio::where('estado_id', '=', $estado_id)->get();
      return view('parroquia.create', compact('estados', 'estado_id', 'municipios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function municipio(Request $request)
    {
      if($request->ajax()){

        $estado_id = $request->estado_id;
        $municipios = Municipio::where('estado_id', '=', $estado_id)->get();
        return $municipios;

      } else { // si no se redirige a index

        return view('/theme/index');

      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if ($request->ajax()) {
        // code...
        $request->validate([
           'municipio_id' => 'required',
           'parroquia' => 'required',
       ]);

        $parroquia = new Parroquia();
        $parroquia->parroquia = $request->parroquia;
        $parroquia->municipio_id = $request->municipio_id;
        $parroquia->save();

        return $parroquia;
      } else { // si no se redirige a index
        // code...
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
      $estados = Estado::all();
      $where = array('id' => $id);
      $data['parroquia_info'] = Parroquia::where($where)->first();
      $data['parroquia_municipio'] = Municipio::where("id",$data['parroquia_info']['municipio_id'])->first();
      $municipios = Municipio::select("municipios.id","municipios.municipio")
      ->where('estado_id', '=', $data['parroquia_municipio']['estado_id'])->get();

      return view('parroquia.edit',compact('estados', 'municipios'), $data);
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
       if($request->ajax()){

         $request->validate([
             'parroquia' => 'required',
             'municipio_id' => 'required',
         ]);

         $update = [
           'parroquia' => $request->parroquia,
           'municipio_id' => $request->municipio_id,
                 ];

         $parroquia = Parroquia::where('id',$id)->update($update);

         return $parroquia;

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
    public function destroy(Request $request, $id)
    {
      if($request->ajax()){

        try {
          //Eliminar registro
          $alergia = Parroquia::where('id',$id)->delete();
          return $alergia;
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
        if($request->ajax()){ // si es por una etición ajax

            $data = Parroquia::all()->count();

            return $data;

        }  else { // si no se redirige a index

          return view('/theme/index');

        }
    }
}
