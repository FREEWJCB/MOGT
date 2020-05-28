<?php

namespace App\Http\Controllers;

use App\Alergia;
use App\tipo_alergia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AlergiaController extends Controller
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

        $alergias = Alergia::where('nombre','like',"%$nombre%")->orderBy('id','asc')->paginate(4)
        ->appends($variablesurl);

        return view('alergia.list', compact('alergias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = tipo_alergia::all();
        return view('alergia.create', compact('tipos'));
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
            'nombre' => 'required',
            'descripcion' => 'required',
            'tipoAlergia_id' => 'required',
        ]);
   
        Alergia::create($request->all());
    
        return Redirect::to('alergia')
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
        $tipos = tipo_alergia::all();

        $where = array('id' => $id);
        $data['alergia_info'] = Alergia::where($where)->first();
 
        return view('alergia.edit',compact('tipos'), $data);
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
            'nombre' => 'required',
            'descripcion' => 'required',
            'tipoAlergia_id' => 'required',
        ]);
         
        $update = [ 'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'tipoAlergia_id' => $request->tipoAlergia_id,
                ];
        Alergia::where('id',$id)->update($update);
   
        return Redirect::to('alergia')
       ->with('success','Alergia actualizada satisfactoriamente');
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
            Alergia::where('id',$id)->delete();
            return Redirect::to('alergia')->with('mensaje','Alergia eliminada satisfactoriamente');
        } 
        catch (\Exception $e) {
            return Redirect::to('alergia')->with('mensaje','No puede ser eliminada, está siendo usada.');
        }
    }
}
