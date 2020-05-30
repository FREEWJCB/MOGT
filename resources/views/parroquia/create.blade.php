@extends('theme.layout')

@section('titulo')
    Crear Parroquia
@endsection

@section('contenido')

<section class="content-header">
    <h1>
        Registrar Parroquia
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="/">
                <i class="fa fa-home"></i> Home
            </a>
        </li>
        <li>
            <a href="{{ route('parroquia.index')}}">Parroquia</a>
        </li>
        <li class="active">Registro</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            @include('includes.form-error')
            <div class="box box-success">
                <div class="box-header with-border">
                </div>
                <form @if($estado_id === 0) action="{{route('parroquia.index')}}/municipio" @else action="{{ route('parroquia.store') }}" @endif id="form-general" class="form-horizontal" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="estado_id" class="col-lg-3 control-label requerido">Estado</label>
                              <div class="col-lg-8">
                                  <select name="estado_id" id="estado_id" class="form-control">
                                      <option value="0">--Seleccione--</option>
                                      @foreach($estados as $estado)
                                          <option @if($estado->id == $estado_id) selected  @endif value="{{$estado['id']}}"> {{$estado['estado']}} </option>
                                      @endforeach
                                  </select>
                              </div>
                        </div>

                        <div class="form-group">
                            <label for="municipio_id" class="col-lg-3 control-label requerido">Municipio</label>
                            <div class="col-lg-8">
                                <select name="municipio_id" id="municipio_id" class="form-control">
                                    <option value="0">--Seleccione--</option>
                                    @if($municipios ?? false)
                                        @foreach($municipios as $municipio)
                                          <option value="{{$municipio['id']}}"> {{$municipio['municipio']}} </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                          <div class="form-group">
                              <label for="parroquia" class="col-lg-3 control-label requerido">Nombre</label>
                              <div class="col-lg-8">
                                <input type="text" name="parroquia" id="parroquia" class="form-control" value="{{old('parroquia')}}" @if($estado_id !== 0) required @endif/>
                              </div>
                          </div>
                        <div class="box-footer">
                            <div class="col-lg-3"></div>
                            <button type="reset" class="btn btn-default">Cancelar</button>
                            @if($estado_id === 0)
                            <button type="submit" class="btn btn-success">Obtener Municipios</button>
                            @else
                            <button type="submit" class="btn btn-success">Guardar</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- <script type="text/javascript">
 function municipio(){
   let id = document.querySelector("select#estado_id");
   fetch(`http://localhost:8000/parroquia/municipio/`+id.value,{
     headers: {
       "Content-Type": "application/json",
       "Accept": "application/json",
       "X-Requested-With": "XMLHttpRequest",
       "X-CSRF-Token": '{{ csrf_token() }}'
     },
   method: 'GET',
   credentials: "same-origin"
   }).then(response=>{
     return response.json()
   }).then(json=>{
       console.log(json)
   }).catch(error=>{
     console.error(error)
   })
 }

</script> -->
@endsection
