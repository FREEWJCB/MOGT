<?php

namespace App\Http\Controllers;

use App\Alergia;
use App\tipo_alergia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class AlergiaController extends Controller
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

        // Se obtiene los datos de la Vista view_alergia
        $alergia = DB::table('view_alergia')
        ->where('nombre','like',"%$nombre%")->orderBy('id','desc')
        ->skip(($pag * 6) - 6) //skip() para saltar entre la consulta
        ->take(6) //para limitar el resultado
        ->get();

            $tipos_a = tipo_alergia::all();

        return compact('alergia', 'tipos_a');
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

       $alergia = new Alergia();
       $alergia->nombre = $request->nombre;
       $alergia->descripcion = $request->descripcion;
       $alergia->tipoAlergia_id = $request->tipoAlergia_id;
       $alergia->save();

       return $alergia;
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

       $alergia = Alergia::where('id',$id)->update($update);

       return $alergia;
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
        $alergia = Alergia::where('id',$id)->delete();
        return $alergia;
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

            $data = Alergia::all()->count();

            return $data;
        }
    }
}
