@extends('theme.layout')

@section('titulo')
    Crear Tipo de discapacidad
@endsection

@section('contenido')

<section class="content-header">
    <h1>
        <i class="fa fa-heart"></i>
        Registrar Tipo de Discapacidad
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="/">
                <i class="fa fa-home"></i> Home
            </a>
        </li>
        <li>
            <a href="{{ route('tipoDiscapacidad.index')}}">Tipo de Discapacidad</a>
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
                <form action="{{ route('tipoDiscapacidad.store') }}" id="form-general" class="form-horizontal" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="tipo_d" class="col-lg-3 control-label requerido">Nombre</label>
                            <div class="col-lg-8">
                                <input type="text" name="tipo_d" id="tipo_d" class="form-control" value="{{old('tipo_d')}}" placeholder="Ingrese el tipo de discapacidad..." required/>
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