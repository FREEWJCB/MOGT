<?php

namespace App\Http\Controllers;

use App\Municipio;
use App\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MunicipioController extends Controller
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

        $municipios = Municipio::where('municipio','like',"%$nombre%")->orderBy('id','asc')->paginate(4)
        ->appends($variablesurl);

        return view('municipio.list', compact('municipios'));
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
         $request->validate([
            'municipio' => 'required',
            'estado_id' => 'required',
        ]);
   
        Municipio::create($request->all());
    
        return Redirect::to('municipio')
       ->with('mensaje','Municipio creada satisfactoriamente.');
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
        $request->validate([
            'municipio' => 'required',
            'estado_id' => 'required',
        ]);
         
        $update = [ 'municipio' => $request->municipio,
                    'estado_id' => $request->estado_id,
                ];
        Municipio::where('id',$id)->update($update);
   
        return Redirect::to('municipio')
       ->with('success','Municipio actualizada satisfactoriamente');
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
            Municipio::where('id',$id)->delete();
            return Redirect::to('municipio')->with('mensaje','Municipio eliminada satisfactoriamente');
        } 
        catch (\Exception $e) {
            return Redirect::to('municipio')->with('mensaje','No puede ser eliminada, está siendo usada.');
        }
    }
}
