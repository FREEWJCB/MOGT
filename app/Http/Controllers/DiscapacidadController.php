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

        $pag = $request->pag;

        $discapacidades = Discapacidad::select('discapacidads.id', 'discapacidads.discapacidad', 'discapacidads.descripciones', 'discapacidads.tipoDiscapacidad_id', 'tipo_discapacidads.tipo_d')
        ->join('tipo_discapacidads', 'discapacidads.tipoDiscapacidad_id', '=', 'tipo_discapacidads.id')
        ->where('discapacidads.discapacidad','like',"%$nombre%")->orderBy('discapacidads.id','desc')
        ->skip(($pag * 6) - 6) //skip() para saltar entre la consulta
        ->take(6) //para limitar el resultado
        ->get();

            $tipos_d = Tipo_discapacidad::all();

        return compact('discapacidades', 'tipos_d');
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

        $discapacidad = new Discapacidad();
        $discapacidad->discapacidad = $request->discapacidad;
        $discapacidad->descripciones = $request->descripciones;
        $discapacidad->tipoDiscapacidad_id = $request->tipoDiscapacidad_id;
        $discapacidad->save();

        return $discapacidad;
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
        $discapacidad = Discapacidad::where('id',$id)->update($update);

        return $discapacidad;
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
            $discapacidad = Discapacidad::where('id',$id)->delete();
            return $discapacidad;
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

            $data = Discapacidad::all()->count();

            return $data;
        }
    }
}
