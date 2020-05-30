@extends('theme.layout')

@section('titulo')
    Crear Cargo
@endsection

@section('contenido')

<section class="content-header">
    <h1>
        Registrar Cargo
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="/">
                <i class="fa fa-home"></i> Home
            </a>
        </li>
        <li>
            <a href="{{ route('cargo.index')}}">Cargo</a>
        </li>
        <li class="active">Registro</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            
            <div class="box box-success">
                <div class="box-header with-border">
                </div>
                <form action="{{ route('cargo.store') }}" id="form-general" class="form-horizontal" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nombre" class="col-lg-3 control-label requerido">Cargo</label>
                            <div class="col-lg-8">
                                <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre')}}" required/>
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