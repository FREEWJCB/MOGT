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

        $pag = $request->pag;

        $cargos = Cargo::where('nombre','like',"%$cargo%")->orderBy('id','desc')
        ->skip(($pag * 6) - 6) //skip() para saltar entre la consulta
        ->take(6) //para limitar el resultado
        ->get();

        return $cargos;
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

        $request->validate([
            'nombre' => 'required',
        ]);

        $cargo = new Cargo();
        $cargo->nombre = $request->nombre;
        $cargo->save();

        return $cargo;
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
        $data = Cargo::where('id',$id)->update($update);

        return $data;

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
            return Cargo::where('id',$id)->delete();
        }
        catch (\Exception $e) {
          return response()->json([
              'status' => 'Ocurrio un error!',
              'msg' => 'No puede ser eliminada, está siendo usada.',
          ],400);
        }
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function contar(Request $request)
    {
      if($request->ajax()){

        $data = Cargo::all()->count();

        return $data;
      }
    }
}
