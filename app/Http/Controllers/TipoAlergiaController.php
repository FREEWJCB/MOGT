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
        $nombre = $request->get('buscar');

        $pag = $request->pag;

        $tipos = tipo_alergia::where('name','like',"%$nombre%")->orderBy('id','desc')
        ->skip(($pag * 6) - 6) //skip() para saltar entre la consulta
        ->take(6) //para limitar el resultado
        ->get();

        return $tipos;
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

        $tipos = new tipo_alergia();
        $tipos->name = $request->name;
        $tipos->save();

        return $tipos;
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
        $data = tipo_alergia::where('id',$id)->update($update);

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
            return tipo_alergia::where('id',$id)->delete();
        }
        catch (\Exception $e) {
          return response()->json([
              'status' => 'Ocurrio un error!',
              'msg' => 'No puede ser eliminada, está siendo usada.',
          ],400);
        }
    }

    public function buscador (Request $request){
        $tiposb = tipo_alergia::where("name","like",$request->texto."%")->take(10)->get();
        return view('tipoAlergia.list', compact('tiposb'));
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function contar(Request $request)
    {
      if($request->ajax()){

        $data = tipo_alergia::all()->count();

        return $data;
      }
    }
}
