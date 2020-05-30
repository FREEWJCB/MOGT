@extends('theme.layout')

@section('titulo')
    Crear Estado
@endsection

@section('contenido')

<section class="content-header">
    <h1>
        Registrar Estado
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
                <form action="{{ route('estado.store') }}" id="form-general" class="form-horizontal" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="estado" class="col-lg-3 control-label requerido">Nombre</label>
                            <div class="col-lg-8">
                                <input type="text" name="estado" id="estado" class="form-control" value="{{old('estado')}}" required/>
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