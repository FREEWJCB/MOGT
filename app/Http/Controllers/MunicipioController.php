<?php

namespace App\Http\Controllers;

use App\Municipio;
use App\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class MunicipioController extends Controller
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

          // Se obtiene los datos de la Vista view_alergia
          $municipio = DB::table('view_municipio')
          ->where('municipio','like',"%$nombre%")->orderBy('id','desc')
          ->skip(($pag * 6) - 6) //skip() para saltar entre la consulta
          ->take(6) //para limitar el resultado
          ->get();

              $estado = Estado::all();

          return compact('municipio', 'estado');
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
        return view('municipio.create', compact('estados'));
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
            'municipio' => 'required',
            'estado_id' => 'required',
        ]);

        $municipio = new Municipio();
        $municipio->municipio = $request->municipio;
        $municipio->estado_id = $request->estado_id;
        $municipio->save();

        return $municipio;
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
        $data['municipio_info'] = Municipio::where($where)->first();

        return view('municipio.edit',compact('estados'), $data);
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
          'municipio' => 'required',
          'estado_id' => 'required',
        ]);

        $update = [
          'municipio' => $request->municipio,
          'estado_id' => $request->estado_id,
        ];

        $municipio = Municipio::where('id',$id)->update($update);

        return $municipio;

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
          $alergia = Municipio::where('id',$id)->delete();
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

            $data = Municipio::all()->count();

            return $data;

        }  else { // si no se redirige a index

          return view('/theme/index');

        }
    }
}
