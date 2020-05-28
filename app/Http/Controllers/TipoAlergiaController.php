<?php

namespace App\Http\Controllers;

use App\tipo_alergia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TipoAlergiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre = $request->get('buscarpor');

        $variablesurl = $request->all();
        
        $tipos = tipo_alergia::where('name','like',"%$nombre%")->orderBy('id','asc')->paginate(4)
        ->appends($variablesurl);

        return view('tipoAlergia.list', compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipoAlergia.create');
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
            'name' => 'required',
        ]);
   
        tipo_alergia::create($request->all());
    
        return Redirect::to('tipoAlergia')
       ->with('mensaje','Tipo de alergia creada satisfactoriamente.');
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
        $data['tipo_info'] = tipo_alergia::where($where)->first();

        return view('tipoAlergia.edit', $data);
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
            'name' => 'required',
        ]);
         
        $update = ['name' => $request->name];
        tipo_alergia::where('id',$id)->update($update);
   
        return Redirect::to('tipoAlergia')
       ->with('success','Tipo de alergia actualizada satisfactoriamente');
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
            tipo_alergia::where('id',$id)->delete();
            return Redirect::to('tipoAlergia')->with('mensaje','Tipo de alergia eliminada satisfactoriamente');
        } 
        catch (\Exception $e) {
            return Redirect::to('tipoAlergia')->with('mensaje','No puede ser eliminada, está siendo usada.');
        }
    }

    public function buscador (Request $request){
        $tiposb = tipo_alergia::where("name","like",$request->texto."%")->take(10)->get();
        return view('tipoAlergia.list', compact('tiposb'));
    }
}