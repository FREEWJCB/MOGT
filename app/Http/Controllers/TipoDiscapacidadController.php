<?php

namespace App\Http\Controllers;

use App\Tipo_discapacidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TipoDiscapacidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre = $request->get('buscar');

        $pag = $request->pag;

        $tipos_d = Tipo_discapacidad::where('tipo_d','like',"%$nombre%")->orderBy('id','desc')
        ->skip(($pag * 6) - 6) //skip() para saltar entre la consulta
        ->take(6) //para limitar el resultado
        ->get();

        return $tipos_d;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipoDiscapacidad.create');
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
            'tipo_d' => 'required',
        ]);

        $tipo_d = new Tipo_discapacidad();
        $tipo_d->tipo_d = $request->tipo_d;
        $tipo_d->save();

        return $tipo_d;
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
        $where = array('id' => $id);
        $data['tipod_info'] = tipo_discapacidad::where($where)->first();

        return view('tipoDiscapacidad.edit', $data);
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
            'tipo_d' => 'required',
        ]);

        $update = ['tipo_d' => $request->tipo_d];
        $data = tipo_discapacidad::where('id',$id)->update($update);

        return $data;
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
            return tipo_discapacidad::where('id',$id)->delete();
        }
        catch (\Exception $e) {
          return response()->json([
              'status' => 'Ocurrio un error!',
              'msg' => 'No puede ser eliminada, está siendo usada.',
          ],400);
        }
    }

    public function buscador (Request $request){
        $tiposb = tipo_discapacidad::where("tipo_d","like",$request->texto."%")->take(10)->get();
        return $tiposb;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contar(Request $request)
    {
        if($request->ajax()){

            $data = tipo_discapacidad::all()->count();

            return $data;
        }
    }
}
