<?php

namespace App\Http\Controllers;

use App\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EstadoController extends Controller
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

        $estados = Estado::where('estado','like',"%$nombre%")->orderBy('id','desc')
        ->skip(($pag * 6) - 6) //skip() para saltar entre la consulta
        ->take(6) //para limitar el resultado
        ->get();

        return $estados;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estado.create');
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
            'estado' => 'required',
        ]);

       $estado = new Estado();
       $estado->estado = $request->estado;
       $estado->save();

       return $estado;
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
        $data['estado_info'] = Estado::where($where)->first();

        return view('estado.edit', $data);
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
            'estado' => 'required',
        ]);

        $update = ['estado' => $request->estado];
        $data = Estado::where('id',$id)->update($update);

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
            return Estado::where('id',$id)->delete();
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

        $data = Estado::all()->count();

        return $data;
      }
    }
}
