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

        $variablesurl = $request->all();

        $tipos_d = Tipo_discapacidad::where('tipo_d','like',"%$nombre%")->orderBy('id','asc')->paginate(4)
        ->appends($variablesurl);

        return view('tipoDiscapacidad.list', compact('tipos_d'));
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

        tipo_discapacidad::create($request->all());

        return Redirect::to('tipoDiscapacidad')
       ->with('mensaje','Tipo de discapacidad creada satisfactoriamente.');
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
        tipo_discapacidad::where('id',$id)->update($update);

        return Redirect::to('tipoDiscapacidad')
       ->with('success','Tipo de discapacidad actualizada satisfactoriamente');
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
            tipo_discapacidad::where('id',$id)->delete();
            return Redirect::to('tipoDiscapacidad')->with('mensaje','Tipo de discapacidad eliminada satisfactoriamente');
        }
        catch (\Exception $e) {
            return Redirect::to('tipoDiscapacidad')->with('mensaje','No puede ser eliminada, está siendo usada.');
        }
    }

    public function buscador (Request $request){
        $tiposb = tipo_discapacidad::where("tipo_d","like",$request->texto."%")->take(10)->get();
        return view('tipoDiscapacidad.list', compact('tiposb'));
    }
}
