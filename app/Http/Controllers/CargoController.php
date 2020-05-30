<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cargo;
use Redirect;

class CargoController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cargo = $request->get('buscar');

        $cargos = Cargo::where('nombre','like',"%$cargo%")->orderBy('id','desc')->paginate(5);
        return view('cargo.list', compact('cargos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cargo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'nombre' => 'required',
        // ]);
   
        Cargo::create($request->all());

        return redirect()->route('cargo.index')->with('datos','Registro Guardado Correctamente!');
    
       //  return Redirect::to('cargo')
       // ->with('success','Cargo Creado Satisfactoriamente.');
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
        $data['cargo_info'] = Cargo::where($where)->first();
 
        return view('cargo.edit', $data);
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
        ]);
         
        $update = ['nombre' => $request->nombre];
        Cargo::where('id',$id)->update($update);

        return redirect()->route('cargo.index')->with('datos','Registro Editado Correctamente!');

       //  return Redirect::to('marca')
       // ->with('success','Marca Actualizado Satisfactoriamente');
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
            Cargo::where('id',$id)->delete();
            return redirect()->route('cargo.index')->with('datos','Registro Eliminado Correctamente!');

            // return Redirect::to('cargo')->with('success','Cargo Eliminado Satisfactoriamente');
        } 
        catch (\Exception $e) {
            return redirect()->route('cargo.index')->with('data','No puede ser eliminado, está siendo usado.');

            // return Redirect::to('cargo')->withSuccess('No puede ser eliminado, está siendo usado.');
        }
    }
}
