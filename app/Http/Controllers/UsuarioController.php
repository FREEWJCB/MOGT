<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UsuarioController extends Controller
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

        $usuarios = User::where('name','like',"%$nombre%")->orderBy('id','asc')->paginate(4)
        ->appends($variablesurl);

        return view('usuario.list', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.create');
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
          'email' => 'required',
          'password' => 'required',
      ]);

      User::create($request->all());

      return Redirect::to('usuario')
     ->with('mensaje','Usuario '.$request->name.' creada satisfactoriamente.');
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
      $data['usuario_info'] = User::where($where)->first();

      return view('usuario.edit', $data);
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
          'email' => 'required',
      ]);

      if($request->password === ''){
              $update = [ 'name' => $request->name,
                          'email' => $request->email,
                      ];
      } else {
              $update = [ 'name' => $request->name,
                          'email' => $request->email,
                          'password' => $request->password,
                      ];
      }

      User::where('id',$id)->update($update);

      return Redirect::to('usuario')
     ->with('success','Usuario actualizada satisfactoriamente');
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
          User::where('id',$id)->delete();
          return Redirect::to('usuario')->with('mensaje','Usuario eliminada satisfactoriamente');
      }
      catch (\Exception $e) {
          return Redirect::to('usuario')->with('mensaje','No puede ser eliminada, está siendo usada.');
      }
    }
}
