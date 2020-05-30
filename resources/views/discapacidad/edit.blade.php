@extends('theme.layout')

@section('titulo')
    Editar Discapacidad
@endsection

@section('contenido')

<section class="content-header">
    <h1>
        Editar Discapacidad
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="/">
                <i class="fa fa-home"></i> Home
            </a>
        </li>
        <li>
            <a href="{{ route('discapacidad.index')}}">Discapacidad</a>
        </li>
        <li class="active">
            {{ $discapacidad_info->discapacidad }}
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
                <form action="{{ route('discapacidad.update', $discapacidad_info->id) }}" id="form-general" class="form-horizontal" name="update_Discapacidad" method="POST">
                    {{ csrf_field() }}
                    @method('PATCH')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="discapacidad" class="col-lg-3 control-label requerido">Discapacidad</label>
                            <div class="col-lg-8">
                              <input type="text" name="discapacidad" id="discapacidad" class="form-control" value="{{ $discapacidad_info->discapacidad }}" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descripciones" class="col-lg-3 control-label requerido">Descripción</label>
                            <div class="col-lg-8">
                              <input type="text" name="descripciones" id="descripciones" class="form-control" value="{{ $discapacidad_info->descripciones }}" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tipoDiscapacidad_id" class="col-lg-3 control-label requerido">Tipo</label>
                            <div class="col-lg-8">
                                <select name="tipoDiscapacidad_id" id="tipoDiscapacidad_id" class="form-control">
                                    <option value="">--Seleccione--</option>
                                    @foreach($tipos_d as $tipo)
                                        <option @if($tipo->id == $discapacidad_info->tipoDiscapacidad_id) selected  @endif
                                        value="{{$tipo['id']}}"> {{$tipo['tipo_d']}} </option>
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