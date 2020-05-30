@extends('theme.layout')

@section('titulo')
    Editar Tipo Discapacidad
@endsection
 
@section('contenido')

<section class="content-header">
    <h1>
        Editar Tipo de Discapacidad
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="/">
                <i class="fa fa-home"></i> Home
            </a>
        </li>
        <li>
            <a href="{{ route('tipoDiscapacidad.index')}}">Tipo de discapacidad</a>
        </li>
        <li class="active">
            {{ $tipod_info->tipo_d }}
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
                <form action="{{ route('tipoDiscapacidad.update', $tipod_info->id) }}" id="form-general" class="form-horizontal" name="update_tipoDiscapacidad" method="POST">
                    {{ csrf_field() }}
                    @method('PATCH')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="tipo_d" class="col-lg-3 control-label requerido">Nombre</label>
                            <div class="col-lg-9">
                              <input type="text" name="tipo_d" id="tipo_d" class="form-control" value="{{ $tipod_info->tipo_d }}" />
                            </div>
                            <div class="col-lg-3">
                                <span class="text-danger">{{ $errors->first('tipo_d') }}</span>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="col-lg-3"></div>
                            <button type="reset" class="btn btn-default">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection