<?php

namespace App\Http\Controllers;

use App\Parroquia;
use App\Municipio;
use App\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ParroquiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre = $request->get('buscar');

        $variablesurl = $request->all();

        $parroquias = Parroquia::select('parroquias.id','parroquias.parroquia','municipios.municipio','estados.estado')
        ->join("municipios",'municipios.id','=','parroquias.municipio_id')
        ->join("estados", "estados.id",'=', "municipios.estado_id")
        ->where('parroquias.parroquia','like',"%$nombre%")
        ->orderBy('parroquias.id','asc')
        ->paginate(4)
        ->appends($variablesurl);

        return view('parroquia.list', compact('parroquias'));
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
      $estado_id = $request->estado_id;
      $municipios = Municipio::where('estado_id', '=', $estado_id)->get();
      $estados = Estado::all();
      return view('parroquia.create', compact('estados', 'estado_id', 'municipios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
         'municipio_id' => 'required',
         'parroquia' => 'required',
     ]);

     Parroquia::create($request->all());

     return Redirect::to('parroquia')
    ->with('mensaje','Parroquia creada satisfactoriamente.');
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
      $request->validate([
          'parroquia' => 'required',
          'municipio_id' => 'required',
      ]);

      $update = [ 'parroquia' => $request->parroquia,
                  'municipio_id' => $request->municipio_id,
              ];
      Parroquia::where('id',$id)->update($update);

      return Redirect::to('parroquia')
     ->with('success','Parroquia actualizada satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {
          //Eliminar registro
          Parroquia::where('id',$id)->delete();
          return Redirect::to('parroquia')->with('mensaje','Parroquia eliminada satisfactoriamente');
      }
      catch (\Exception $e) {
          return Redirect::to('parroquia')->with('mensaje','No puede ser eliminada, está siendo usada.');
      }
    }
}
