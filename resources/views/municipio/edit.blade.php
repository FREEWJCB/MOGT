@extends('theme.layout')

@section('titulo')
    Editar Municipio
@endsection

@section('contenido')

<section class="content-header">
    <h1>
        Editar Municipio
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="/">
                <i class="fa fa-home"></i> Home
            </a>
        </li>
        <li>
            <a href="{{ route('municipio.index')}}">Municipio</a>
        </li>
        <li class="active">
            {{ $municipio_info->municipio }}
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
                <form action="{{ route('municipio.update', $municipio_info->id) }}" id="form-general" class="form-horizontal" name="update_Municipio" method="POST">
                    {{ csrf_field() }}
                    @method('PATCH')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="municipio" class="col-lg-3 control-label requerido">Nombre</label>
                            <div class="col-lg-8">
                              <input type="text" name="municipio" id="municipio" class="form-control" value="{{ $municipio_info->municipio }}" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="estado_id" class="col-lg-3 control-label requerido">Estado</label>
                            <div class="col-lg-8">
                                <select name="estado_id" id="estado_id" class="form-control">
                                    <option value="">--Seleccione--</option>
                                    @foreach($estados as $estado)
                                        <option @if($estado->id == $municipio_info->estado_id) selected  @endif
                                        value="{{$estado['id']}}"> {{$estado['estado']}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="col-lg-3"></div>
                            <button type="reset" class="btn btn-default">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection