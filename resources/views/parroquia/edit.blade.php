@extends('theme.layout')

@section('titulo')
    Editar Parroquia
@endsection

@section('contenido')

<section class="content-header">
    <h1>
        Editar Parroquia
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
        <li class="active">
            {{ $parroquia_info->parroquia }}
        </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            @include('includes.form-error')
            <div class="box box-danger">
                <div class="box-header with-border">
                </div>
                <form action="{{ route('parroquia.update', $parroquia_info->id) }}" id="form-general" class="form-horizontal" name="update_Parroquia" method="POST">
                    {{ csrf_field() }}
                    @method('PATCH')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="estado_id" class="col-lg-3 control-label requerido">Estado</label>
                            <div class="col-lg-8">
                                <select name="estado_id" id="estado_id" class="form-control">
                                    <option value="">--Seleccione--</option>
                                    @foreach($estados as $estado)
                                        <option @if($estado->id == $parroquia_municipio->estado_id) selected  @endif
                                        value="{{$estado['id']}}"> {{$estado['estado']}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="municipio_id" class="col-lg-3 control-label requerido">Municipio</label>
                            <div class="col-lg-8">
                                <select name="municipio_id" id="municipio_id" class="form-control">
                                    <option value="0">--Seleccione--</option>
                                        @foreach($municipios as $municipio)
                                          <option @if($municipio->id === $parroquia_info->municipio_id) selected @endif value="{{$municipio['id']}}"> {{$municipio['municipio']}} </option>
                                        @endforeach
                                </select>
                                {{$municipios[0]->id}}-{{$parroquia_info->municipio_id}}
                            </div>
                        </div>
                            <div class="form-group">
                                <label for="parroquia" class="col-lg-3 control-label requerido">Nombre</label>
                                <div class="col-lg-8">
                                  <input type="text" name="parroquia" id="parroquia" class="form-control" value="{{ $parroquia_info->parroquia }}" required/>
                                </div>
                            </div>
                        <div class="box-footer">
                            <div class="col-lg-3"></div>
                            <button type="reset" class="btn btn-default">Cancelar</button>
                            @if($parroquia_municipio->estado_id === 0)
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
@endsection
