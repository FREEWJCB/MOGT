@extends('theme.layout')

@section('titulo')
    Editar Estado
@endsection
 
@section('contenido')

<section class="content-header">
    <h1>
        Editar Estado
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="/">
                <i class="fa fa-home"></i> Home
            </a>
        </li>
        <li>
            <a href="{{ route('estado.index')}}">Estado</a>
        </li>
        <li class="active">
            {{ $estado_info->estado }}
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
                <form action="{{ route('estado.update', $estado_info->id) }}" id="form-general" class="form-horizontal" name="update_estado" method="POST">
                    {{ csrf_field() }}
                    @method('PATCH')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="estado" class="col-lg-3 control-label requerido">Nombre</label>
                            <div class="col-lg-9">
                              <input type="text" name="estado" id="estado" class="form-control" value="{{ $estado_info->estado }}" />
                            </div>
                            <div class="col-lg-3">
                                <span class="text-danger">{{ $errors->first('estado') }}</span>
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