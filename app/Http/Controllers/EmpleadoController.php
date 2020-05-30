<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use App\Cargo;
use Redirect;

class EmpleadoController extends Controller
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
        $empleado = $request->get('buscar');

        $empleados = Empleado::where('cedula','like',"%$empleado%")->orderBy('id','desc')->paginate(5);
        return view('empleado.list', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cargos = Cargo::all();
        return view('empleado.create', compact('cargos'));
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
            'cedula' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'sexo' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
            'cargo_id' => 'required',
        ]);
   
        Empleado::create($request->all());

        return redirect()->route('empleado.index')->with('datos','Registro Guardado Correctamente!');
    
       //  return Redirect::to('empleado')
       // ->with('success','Empleado Creado Satisfactoriamente.');
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
        $cargos = Cargo::all();

        $where = array('id' => $id);
        $data['empleado_info'] = Empleado::where($where)->first();
 
        return view('empleado.edit',compact('cargos'), $data);
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
            'cedula' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'sexo' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
            'cargo_id' => 'required',
        ]);
         
        $update = [ 'cedula' => $request->cedula,
                    'nombres' => $request->nombres,
                    'apellidos' => $request->apellidos,
                    'sexo' => $request->sexo,
                    'telefono' => $request->telefono,
                    'correo' => $request->correo,
                    'cargo_id' => $request->cargo_id,
                ];
        Empleado::where('id',$id)->update($update);

        return redirect()->route('empleado.index')->with('datos','Registro Editado Correctamente!');
   
       //  return Redirect::to('empleado')
       // ->with('success','Empleado Actualizado Satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Empleado::where('id',$id)->delete();
        return redirect()->route('empleado.index')->with('datos','Registro Eliminado Correctamente!');

        // return Redirect::to('empleado')->with('success','Empleado Eliminado Satisfactoriamente');
    }
}
