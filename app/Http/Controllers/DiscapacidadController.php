<?php

namespace App\Http\Controllers;

use App\Discapacidad;
use App\Tipo_discapacidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DiscapacidadController extends Controller
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

        $discapacidades = Discapacidad::where('discapacidad','like',"%$nombre%")->orderBy('id','asc')->paginate(4)
        ->appends($variablesurl);

        return view('discapacidad.list', compact('discapacidades'));
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
        $request->validate([
            'discapacidad' => 'required',
            'descripciones' => 'required',
            'tipoDiscapacidad_id' => 'required',
        ]);
   
        Discapacidad::create($request->all());
    
        return Redirect::to('discapacidad')
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
        $request->validate([
            'discapacidad' => 'required',
            'descripciones' => 'required',
            'tipoDiscapacidad_id' => 'required',
        ]);
         
        $update = [ 'discapacidad' => $request->discapacidad,
                    'descripciones' => $request->descripciones,
                    'tipoDiscapacidad_id' => $request->tipoDiscapacidad_id,
                ];
        Discapacidad::where('id',$id)->update($update);
   
        return Redirect::to('discapacidad')
       ->with('success','Discapacidad actualizada satisfactoriamente');
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
            Discapacidad::where('id',$id)->delete();
            return Redirect::to('discapacidad')->with('mensaje','Discapacidad eliminada satisfactoriamente');
        } 
        catch (\Exception $e) {
            return Redirect::to('discapacidad')->with('mensaje','No puede ser eliminada, está siendo usada.');
        }
    }
}
